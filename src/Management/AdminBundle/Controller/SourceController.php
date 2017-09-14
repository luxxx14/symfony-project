<?php

namespace Management\AdminBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Management\AdminBundle\Entity\Source;
use Management\AdminBundle\Entity\SourceLink;
use Management\AdminBundle\Entity\SourceLinkTranslation;
use Management\AdminBundle\Entity\SourceTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Source controller.
 *
 * @Route("admin/source")
 */
class SourceController extends Controller
{
    /**
     * Redirects to required route.
     *
     * @Route("/{action}/", requirements={"action" = "(index|new)"},
     *     name="admin_source_redirect")
     * @Method("GET")
     */
    public function redirectAction(string $action) {
        $em = $this->getDoctrine()->getManager();

        $defaultLocale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['selected' => TRUE]);

        if ($action == 'index') {
            return $this->redirectToRoute('admin_source_translation_index', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
        else {
            return $this->redirectToRoute('admin_source_translation_new', [
                'locale' => $defaultLocale->getShortname()
            ]);
        }
    }

    /**
     * Lists all source entities.
     *
     * @Route("/{locale}/", name="admin_source_translation_index")
     * @Method("GET")
     */
    public function indexAction(string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $sources = $em->getRepository('ManagementAdminBundle:Source')->findAll();
//            ->createQueryBuilder('s')
//            ->leftJoin('s.sourceLinks', 'sL')
////            ->orderBy('s.id', 'ASC')
//            ->orderBy('sL.id', 'ASC')
//            ->getQuery()
//            ->getResult();

        return $this->render('@ManagementAdmin/source/index.html.twig', array(
            'sources' => $sources,
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Creates a new source entity.
     *
     * @Route("/{locale}/new", requirements={"locale" = ".[a-zA-Z]"}, name="admin_source_translation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = new SourceTranslation($locale);

        $form = $this->createForm('Management\AdminBundle\Form\SourceTranslationType', $translation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $source = new Source();
            $em->persist($source);

            $translation->setSource($source);
            $em->persist($translation);

            foreach ($form->get('sourceLinkTranslations')->getData() as $currentSourceLinkTranslation) {
                $currentSourceLink = new SourceLink();
                $currentSourceLink->setSource($source);
                $currentSourceLink->setUrl($currentSourceLinkTranslation->getUrl());
                $em->persist($currentSourceLink);

                $currentSourceLinkTranslation->setSource($currentSourceLink);
                $currentSourceLinkTranslation->setSourceTranslation($translation);
                $currentSourceLinkTranslation->setLocale($locale);
                $em->persist($currentSourceLinkTranslation);
            }

            foreach ($locales as $currentLocale) {
                if ($currentLocale != $locale) {
                    $currentTranslation = new SourceTranslation($currentLocale);
                    $currentTranslation->setSource($source);
                    $em->persist($currentTranslation);

                    foreach ($form->get('sourceLinkTranslations')->getData() as $item) {
                        $currentTranslationSourceLink = new SourceLinkTranslation($currentLocale);
                        $currentTranslationSourceLink->setSource($item->getSource());
                        $currentTranslationSourceLink->setSourceTranslation($currentTranslation);
                        $currentTranslationSourceLink->setUrl($item->getUrl());
                        $em->persist($currentTranslationSourceLink);
                    }
                }
            }

//            var_dump($translation);
//            var_dump($form->get('sourceLinkTranslations')->getData());
//            $em->vvv();
            $em->flush();

            return $this->redirectToRoute('admin_source_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/source/new.html.twig', array(
            'translation' => $translation,
            'form' => $form->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Finds and displays a source entity.
     *
     * @Route("/{id}", name="admin_source_show")
     * @Method("GET")
     */
    public function showAction(Source $source)
    {
        $deleteForm = $this->createDeleteForm($source);

        return $this->render('@ManagementAdmin/source/show.html.twig', array(
            'source' => $source,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing source entity.
     *
     * @Route("/{id}/{locale}/edit", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_source_translation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Source $source, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        $translation = $em->getRepository('ManagementAdminBundle:SourceTranslation')
            ->findOneBy(['source' => $source, 'locale' => $locale]);
//        if (!$translation) {
//            $translation = new SourceTranslation($locale);
//            $translation->setSource($source);
//            $em->persist($translation);
//        }

//        $deleteForm = $this->createDeleteForm($source);
        $editForm = $this->createForm('Management\AdminBundle\Form\SourceTranslationType', $translation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $currentSourceLinkTranslations = $em->getRepository('ManagementAdminBundle:SourceLinkTranslation')
                ->findBy(['sourceTranslation' => $translation]);

            foreach ($editForm->get('sourceLinkTranslations')->getData() as $sourceLinkTranslation) {
                if (!$sourceLinkTranslation->getId()) {
                    $currentSourceLink = new SourceLink();
                    $currentSourceLink->setSource($source);
                    $currentSourceLink->setUrl($sourceLinkTranslation->getUrl());
                    $em->persist($currentSourceLink);

                    $sourceLinkTranslation->setSource($currentSourceLink);
                    $sourceLinkTranslation->setSourceTranslation($translation);
                    $sourceLinkTranslation->setLocale($locale);
                    $em->persist($sourceLinkTranslation);

                    foreach ($locales as $currentLocale) {
                        if ($currentLocale != $locale) {
                            $currentTranslation = $em->getRepository('ManagementAdminBundle:SourceTranslation')
                                ->findOneBy(['source' => $source, 'locale' => $currentLocale]);
                            $sourceLinkTranslation = new SourceLinkTranslation($currentLocale);
                            $sourceLinkTranslation->setSource($currentSourceLink);
                            $sourceLinkTranslation->setSourceTranslation($currentTranslation);
                            $sourceLinkTranslation->setUrl($currentSourceLink->getUrl());
                            $em->persist($sourceLinkTranslation);
                        }
                    }
                }
            }

            foreach ($currentSourceLinkTranslations as $currentSourceLinkTranslation) {
                if (!$translation->getSourceLinkTranslations()->contains($currentSourceLinkTranslation)) {
                    $unnecessaryItems = $em->getRepository('ManagementAdminBundle:SourceLinkTranslation')
                        ->findBy(['source' => $currentSourceLinkTranslation->getSource()]);
                    foreach ($unnecessaryItems as $unnecessaryItem) {
                        $em->remove($unnecessaryItem);
                    }
                    $em->remove($currentSourceLinkTranslation->getSource());
                }
            }

            $em->flush();

            return $this->redirectToRoute('admin_source_translation_index', [
                'locale' => $locale->getShortname()
            ]);
        }

        return $this->render('@ManagementAdmin/source/edit.html.twig', array(
            'source' => $source,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
            'locale' => $locale,
            'locales' => $locales
        ));
    }

    /**
     * Deletes a source entity.
     *
     * @Route("/{id}/{locale}/delete", requirements={"id" = "\d+", "locale" = ".[a-zA-Z]"},
     *     name="admin_source_delete")
     * Method("DELETE")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Source $source, string $locale)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['shortname' => $locale]);

        $em = $this->getDoctrine()->getManager();
        foreach ($source->getTranslations() as $translation) {
            $em->remove($translation);
        }
        $em->remove($source);
        $em->flush();
//        $form = $this->createDeleteForm($source);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($source);
//            $em->flush();
//        }

        return $this->redirectToRoute('admin_source_translation_index', [
            'locale' => $locale->getShortname()
        ]);
    }

    /**
     * Creates a form to delete a source entity.
     *
     * @param Source $source The source entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Source $source)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_source_translation_delete', array('id' => $source->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
