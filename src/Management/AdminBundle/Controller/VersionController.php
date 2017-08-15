<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Version;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Version controller.
 *
 * @Route("admin/version")
 */
class VersionController extends Controller
{
    /**
     * Lists all version entities.
     *
     * @Route("/", name="admin_version_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $versions = $em->getRepository('ManagementAdminBundle:Version')->findAll();

        return $this->render('@ManagementAdmin/version/index.html.twig', array(
            'versions' => $versions,
        ));
    }

    /**
     * Creates a new version entity.
     *
     * @Route("/new", name="admin_version_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $version = new Version();
        $form = $this->createForm('Management\AdminBundle\Form\VersionType', $version);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($version);
            $em->flush();

            return $this->redirectToRoute('admin_version_show', array('id' => $version->getId()));
        }

        return $this->render('@ManagementAdmin/version/new.html.twig', array(
            'version' => $version,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a version entity.
     *
     * @Route("/{id}", name="admin_version_show")
     * @Method("GET")
     */
    public function showAction(Version $version)
    {
        $deleteForm = $this->createDeleteForm($version);

        return $this->render('@ManagementAdmin/version/show.html.twig', array(
            'version' => $version,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing version entity.
     *
     * @Route("/{id}/edit", name="admin_version_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Version $version)
    {
        $deleteForm = $this->createDeleteForm($version);
        $editForm = $this->createForm('Management\AdminBundle\Form\VersionType', $version);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_version_edit', array('id' => $version->getId()));
        }

        return $this->render('@ManagementAdmin/version/edit.html.twig', array(
            'version' => $version,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a version entity.
     *
     * @Route("/{id}", name="admin_version_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Version $version)
    {
        $form = $this->createDeleteForm($version);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($version);
            $em->flush();
        }

        return $this->redirectToRoute('admin_version_index');
    }

    /**
     * Creates a form to delete a version entity.
     *
     * @param Version $version The version entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Version $version)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_version_delete', array('id' => $version->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
