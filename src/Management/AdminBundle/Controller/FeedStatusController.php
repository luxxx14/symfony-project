<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\FeedStatus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Feedstatus controller
 *
 * @Route("admin/feed_status")
 */
class FeedStatusController extends Controller
{
    /**
     * Lists all feedStatus entities.
     *
     * @Route("/", name="admin_feed_status_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $feedStatuses = $em->getRepository('ManagementAdminBundle:FeedStatus')->findAll();

        return $this->render('@ManagementAdmin/feedstatus/index.html.twig', array(
            'feedStatuses' => $feedStatuses,
        ));
    }

    /**
     * Creates a new feedStatus entity.
     *
     * @Route("/new", name="admin_feed_status_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $feedStatus = new Feedstatus();
        $form = $this->createForm('Management\AdminBundle\Form\FeedStatusType', $feedStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feedStatus);
            $em->flush();

            return $this->redirectToRoute('admin_feed_status_index');
        }

        return $this->render('@ManagementAdmin/feedstatus/new.html.twig', array(
            'feedStatus' => $feedStatus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a feedStatus entity.
     *
     * @Route("/{id}", name="admin_feed_status_show")
     * @Method("GET")
     */
    public function showAction(FeedStatus $feedStatus)
    {
        $deleteForm = $this->createDeleteForm($feedStatus);

        return $this->render('@ManagementAdmin/feedstatus/show.html.twig', array(
            'feedStatus' => $feedStatus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing feedStatus entity.
     *
     * @Route("/{id}/edit", name="admin_feed_status_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FeedStatus $feedStatus)
    {
        $deleteForm = $this->createDeleteForm($feedStatus);
        $editForm = $this->createForm('Management\AdminBundle\Form\FeedStatusType', $feedStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_feed_status_index');
        }

        return $this->render('@ManagementAdmin/feedstatus/edit.html.twig', array(
            'feedStatus' => $feedStatus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a feedStatus entity.
     *
     * @Route("/{id}", name="admin_feed_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FeedStatus $feedStatus)
    {
        $form = $this->createDeleteForm($feedStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($feedStatus);
            $em->flush();
        }

        return $this->redirectToRoute('admin_feed_status_index');
    }

    /**
     * Creates a form to delete a feedStatus entity.
     *
     * @param FeedStatus $feedStatus The feedStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FeedStatus $feedStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_feed_status_delete', array('id' => $feedStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
