<?php

namespace Management\AdminBundle\Controller;

use FeedIo\Reader\ReadErrorException;
use Management\AdminBundle\Entity\Feed;
use Management\AdminBundle\Entity\FeedSource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feedsource controller
 *
 * @Route("admin/feed_source")
 */
class FeedSourceController extends Controller
{

    /**
     * Lists all feedSource entities
     *
     * @Route("/", name="admin_feed_source_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $em = $this->getDoctrine()->getManager();

        $feedSources = $em->getRepository('ManagementAdminBundle:FeedSource')
            ->createQueryBuilder('fS')
            ->orderBy('fS.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/feedsource/index.html.twig', array(
            'feedSources' => $feedSources,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new feedSource entity
     *
     * @Route("/new", name="admin_feed_source_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $feedSource = new Feedsource();
        $form = $this->createForm('Management\AdminBundle\Form\FeedSourceType', $feedSource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            try {
                $modifiedSince = new \DateTime('2015-01-01');

                $feedIo = $this->container->get('feedio');

                /** Now fetch its (fresh) content */
                $feed = $feedIo->readSince($feedSource->getUrl(), $modifiedSince)->getFeed();

                $feedSource->setPublicId($feed->getPublicId());
                $feedSource->setLink($feed->getLink());
                $feedSource->setTitle($feed->getTitle());
                $feedSource->setDescription($feed->getDescription());
                $feedSource->setLastModified($feed->getLastModified());

                if ($feedSource->getLocale()) {
                    $feedSourcesWithSameLocale = $em->getRepository('ManagementAdminBundle:FeedSource')
                        ->findBy(['locale' => $feedSource->getLocale()]);

                    foreach ($feedSourcesWithSameLocale as $feedSourceWithSameLocale) {
                        $feedSourceWithSameLocale->setLocale(NULL);
                        $em->persist($feedSourceWithSameLocale);
                    }
                }

//                if ($feedSource->getSelected()) {
//                    $selectedFeedSource = $em->getRepository('ManagementAdminBundle:FeedSource')
//                        ->findOneBy(['selected' => TRUE]);
//                    if ($selectedFeedSource) {
//                        $selectedFeedSource->setSelected(FALSE);
//                        $em->persist($selectedFeedSource);
//                    }
//                }

                $em->persist($feedSource);
                $em->flush();

                foreach ($feed as $item) {
                    $loadedItem = $em->getRepository('ManagementAdminBundle:Feed')
                        ->findOneBy(['link' => $item->getLink()]);

                    if (/*!$loadedItem and */!($this->startsWith($item->getTitle(), 'Re: ['))) {
                        $feed = new Feed(
                            $item->getPublicId(),
                            $item->getTitle(),
                            $item->getDescription(),
                            $item->getAuthor()->getName(),
                            $item->getLastModified(),
                            $item->getLink(),
                            $feedSource,
                            $em->getRepository('ManagementAdminBundle:FeedStatus')
                                ->findOneBy(['name' => 'Опубликована'])
                        );

                        $em->persist($feed);
                    }
                }

                $em->flush();
            }
            catch (ReadErrorException $exception) {
                return $this->render('@ManagementAdmin/feedsource/error.html.twig');
            }

            return $this->redirectToRoute('admin_feed_source_index');
        }

        return $this->render('@ManagementAdmin/feedsource/new.html.twig', array(
            'feedSource' => $feedSource,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * Finds and displays a feedSource entity
     *
     * @Route("/{id}", name="admin_feed_source_show")
     * @Method("GET")
     */
    public function showAction(FeedSource $feedSource)
    {
        $deleteForm = $this->createDeleteForm($feedSource);

        return $this->render('@ManagementAdmin/feedsource/show.html.twig', array(
            'feedSource' => $feedSource,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing feedSource entity
     *
     * @Route("/{id}/edit", name="admin_feed_source_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FeedSource $feedSource)
    {
        $deleteForm = $this->createDeleteForm($feedSource);
        $editForm = $this->createForm('Management\AdminBundle\Form\FeedSourceEditType', $feedSource);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $modifiedSince = new \DateTime('2015-01-01');

            $feedIo = $this->container->get('feedio');

            /** Now fetch its (fresh) content */
            $feed = $feedIo->readSince($feedSource->getUrl(), $modifiedSince)
                ->getFeed();

            $feedSource->setPublicId($feed->getPublicId());
            $feedSource->setLink($feed->getLink());
            $feedSource->setTitle($feed->getTitle());
            $feedSource->setDescription($feed->getDescription());
            $feedSource->setLastModified($feed->getLastModified());

            if ($feedSource->getLocale()) {
                $feedSourcesWithSameLocale = $em->getRepository('ManagementAdminBundle:FeedSource')
                    ->findBy(['locale' => $feedSource->getLocale()]);

                foreach ($feedSourcesWithSameLocale as $feedSourceWithSameLocale) {
                    $feedSourceWithSameLocale->setLocale(NULL);
                    $em->persist($feedSourceWithSameLocale);
                }
            }

//            if ($feedSource->getSelected()) {
//                $selectedFeedSource = $em->getRepository('ManagementAdminBundle:FeedSource')
//                    ->findOneBy(['selected' => TRUE]);
//                if ($selectedFeedSource) {
//                    $selectedFeedSource->setSelected(FALSE);
//                    $em->persist($selectedFeedSource);
//                }
//            }

            $em->persist($feedSource);
            $em->flush();

            return $this->redirectToRoute('admin_feed_source_index');
        }

        return $this->render('@ManagementAdmin/feedsource/edit.html.twig', array(
            'feedSource' => $feedSource,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a feedSource entity
     *
     * @Route("/{id}/delete", name="admin_feed_source_delete")
     * Method("DELETE")
     * @Method("GET")
     */
    public function deleteAction(Request $request, FeedSource $feedSource)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($feedSource);
        $em->flush();
//        $form = $this->createDeleteForm($feedSource);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($feedSource);
//            $em->flush();
//        }

        return $this->redirectToRoute('admin_feed_source_index');
    }

    /**
     * Creates a form to delete a feedSource entity.
     *
     * @param FeedSource $feedSource The feedSource entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FeedSource $feedSource)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_feed_source_delete', array('id' => $feedSource->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Redirect to some route related with selected feed source
     *
     * @Route("/redirect_for_selected_feed_source/{action}", name="admin_redirect_for_selected_feed_source",
     *     requirements={"action" = "(show|show_feed)"})
     * @Method("GET")
     *
     * @param string $action
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectForSelectedFeedSourceAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        $selectedFeedSource = $em->getRepository('ManagementAdminBundle:FeedSource')
            ->findOneBy(['locale' => $defaultLocale]);
        $selectedFeedSourceId = $selectedFeedSource->getId();

        if ($action == 'show') {
            return $this->redirectToRoute('admin_feed_source_show', ['id' => $selectedFeedSourceId]);
        }
        else {
            return $this->redirectToRoute('admin_feed_source_show_feed', ['id' => $selectedFeedSourceId]);
        }
    }

    /**
     * Show all feed entities of source
     *
     * @Route("/{id}/show_feed", name="admin_feed_source_show_feed")
     * @Method("GET")
     *
     * @param Request $request
     * @param FeedSource $feedSource
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showFeedAction(Request $request, FeedSource $feedSource)
    {
        $em = $this->getDoctrine()->getManager();

        $filterForm = $this->createForm('Management\AdminBundle\Form\FeedFilterType', new Feed());
        $filterForm->handleRequest($request);

        $qb = $this->getDoctrine()
            ->getRepository('ManagementAdminBundle:Feed')->createQueryBuilder('f')
            ->where('f.feedSource = :feedSource')
            ->setParameter('feedSource', $feedSource)
            ;

        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $feedStatus = $filterForm->get('status')->getData();
            if ($feedStatus) {
                $qb
                    ->where('f.status = :status')
                    ->setParameter('status', $feedStatus->getName());
            }
            $lastModified = $filterForm->get('lastModified')->getData();
            if ($lastModified) {
                $qb
                    ->andWhere('f.lastModified >= :lastModified')
                    ->setParameter('lastModified', $lastModified);
            }
        }

        $qb
            ->orderBy('f.status', 'ASC')
            ->orderBy('f.lastModified', 'DESC')
        ;

        $query = $qb->getQuery();
        $feed = $query->getResult();

        $usedLocalesIDs = $em
            ->createQueryBuilder()
            ->select('DISTINCT usedLocales.id')
            ->from('ManagementAdminBundle:FeedSource', 'fS')
            ->join('fS.locale', 'usedLocales')
            ->where('usedLocales.id IS NOT NULL')
            ->orderBy('usedLocales.id', 'ASC')
            ->getQuery()
            ->getResult();

        $usedLocales = $em
            ->getRepository('TranslationLocaleBundle:Locale')
            ->createQueryBuilder('l')
            ->where('l.id IN (:usedLocalesIDs)')
            ->setParameter('usedLocalesIDs', $usedLocalesIDs)
            ->getQuery()
            ->getResult();

        $feedSources = $em->getRepository('ManagementAdminBundle:FeedSource')->findAll();

//        $paginator  = $this->get('knp_paginator');
//        $feed = $paginator->paginate(/*$pagination = $paginator->paginate(*/
//            $query, /* query NOT result */
//            $request->query->getInt('page', 1)/*page number*/,
//            30/*limit per page*/
//        );

//        $feed = $em->getRepository('ManagementAdminBundle:Feed')->findAll();

        return $this->render('@ManagementAdmin/feedsource/show_feed.html.twig', [
            'filterForm' => $filterForm->createView(),
            'feed' => $feed,
            'feedSource' => $feedSource,
            'feedSources' => $feedSources,
            'usedLocales' => $usedLocales
//            'form' => $this->createForm('Management\AdminBundle\Form\FeedDownloadType', $feedSource)
//            ->createView()
        ]);
    }

    /**
     * Download feed from feed source later than specified date
     *
     * @Route("/{id}/download_feed", name="admin_feed_source_download_feed")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param FeedSource $feedSource
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function downloadFeedAction(Request $request, FeedSource $feedSource)
    {
        $form = $this->createForm('Management\AdminBundle\Form\FeedDownloadType', $feedSource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modifiedSince = $form->get('modifiedSince')->getData();
            $modifiedSince = empty($modifiedSince) ? new \DateTime('NOW') : $modifiedSince;

            $feedIo = $this->container->get('feedio');

            /** Now fetch its (fresh) content */
            $feed = $feedIo->readSince($feedSource->getUrl(), $modifiedSince)->getFeed();

            $em = $this->getDoctrine()->getManager();

            foreach ($feed as $item) {
                $loadedItem = $em->getRepository('ManagementAdminBundle:Feed')->findOneBy(['link' => $item->getLink()]);

                if (!$loadedItem) {
                    $feed = new Feed(
                        $item->getPublicId(),
                        $item->getTitle(),
                        $item->getDescription(),
                        $item->getAuthor()->getName(),
                        $item->getLastModified(),
                        $item->getLink(),
                        $feedSource,
                        $em->getRepository('ManagementAdminBundle:FeedStatus')->findOneBy(['name' => 'Опубликована'])
                    );

                    $em->persist($feed);
                    $em->flush();
                }
            }
        }

        return $this->redirectToRoute('admin_feed_source_show_feed', [
            'id' => $feedSource->getId()
        ]);
    }
}
