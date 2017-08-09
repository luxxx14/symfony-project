<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Component;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Component controller.
 *
 * @Route("admin/component")
 */
class ComponentController extends Controller
{
    /**
     * Lists all component entities.
     *
     * @Route("/", name="admin_component_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $components = $em->getRepository('ManagementAdminBundle:Component')->findAll();

        return $this->render('@ManagementAdmin/component/index.html.twig', array(
            'components' => $components,
        ));
    }

    /**
     * Creates a new component entity.
     *
     * @Route("/new", name="admin_component_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $component = new Component();
        $form = $this->createForm('Management\AdminBundle\Form\ComponentType', $component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($component);
            $em->flush();

            return $this->redirectToRoute('admin_component_index');
        }

        return $this->render('@ManagementAdmin/component/new.html.twig', array(
            'component' => $component,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a component entity.
     *
     * @Route("/{id}", name="admin_component_show")
     * @Method("GET")
     */
    public function showAction(Component $component)
    {
        $deleteForm = $this->createDeleteForm($component);

        return $this->render('@ManagementAdmin/component/show.html.twig', array(
            'component' => $component,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing component entity.
     *
     * @Route("/{id}/edit", name="admin_component_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Component $component)
    {
        $deleteForm = $this->createDeleteForm($component);
        $editForm = $this->createForm('Management\AdminBundle\Form\ComponentType', $component);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_component_index');
        }

        return $this->render('@ManagementAdmin/component/edit.html.twig', array(
            'component' => $component,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a component entity.
     *
     * @Route("/{id}", name="admin_component_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Component $component)
    {
        $form = $this->createDeleteForm($component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($component);
            $em->flush();
        }

        return $this->redirectToRoute('admin_component_index');
    }

    /**
     * Creates a form to delete a component entity.
     *
     * @param Component $component The component entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Component $component)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_component_delete', array('id' => $component->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
