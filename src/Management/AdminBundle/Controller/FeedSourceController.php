<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\FeedSource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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

        $feedSources = $em->getRepository('ManagementAdminBundle:FeedSource')->findAll();

        return $this->render('@ManagementAdmin/feedsource/index.html.twig', array(
            'feedSources' => $feedSources,
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

            $feedIo = $this->container->get('feedio');

            /** Now fetch its (fresh) content */
            $feed = $feedIo->readSince($feedSource->getUrl(), new \DateTime('NOW'))->getFeed();

            $feedSource->setPublicId($feed->getPublicId());
            $feedSource->setTitle($feed->getTitle());
            $feedSource->setDescription($feed->getDescription());
            $feedSource->setLastModified($feed->getLastModified());

            $em->persist($feedSource);
            $em->flush();

            return $this->redirectToRoute('admin_feed_source_show', array('id' => $feedSource->getId()));
        }

        return $this->render('@ManagementAdmin/feedsource/new.html.twig', array(
            'feedSource' => $feedSource,
            'form' => $form->createView(),
        ));
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
        $editForm = $this->createForm('Management\AdminBundle\Form\FeedSourceType', $feedSource);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $feedIo = $this->container->get('feedio');

            /** Now fetch its (fresh) content */
            $feed = $feedIo->readSince($feedSource->getUrl(), new \DateTime('NOW'))->getFeed();

            $feedSource->setPublicId($feed->getPublicId());
            $feedSource->setTitle($feed->getTitle());
            $feedSource->setDescription($feed->getDescription());
            $feedSource->setLastModified($feed->getLastModified());

            $em->persist($feedSource);
            $em->flush();

            return $this->redirectToRoute('admin_feed_source_edit', array('id' => $feedSource->getId()));
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
     * @Route("/{id}", name="admin_feed_source_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FeedSource $feedSource)
    {
        $form = $this->createDeleteForm($feedSource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($feedSource);
            $em->flush();
        }

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
}
