<?php

namespace Management\AdminBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Management\AdminBundle\Entity\Source;
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
     * Lists all source entities.
     *
     * @Route("/", name="admin_source_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sources = $em->getRepository('ManagementAdminBundle:Source')//->findAll();
            ->createQueryBuilder('s')
            ->leftJoin('s.sourceLinks', 'sL')
//            ->orderBy('s.id', 'ASC')
            ->orderBy('sL.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/source/index.html.twig', array(
            'sources' => $sources,
        ));
    }

    /**
     * Creates a new source entity.
     *
     * @Route("/new", name="admin_source_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $source = new Source();
        $form = $this->createForm('Management\AdminBundle\Form\SourceType', $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($source);
            $em->flush();

            return $this->redirectToRoute('admin_source_show', array('id' => $source->getId()));
        }

        return $this->render('@ManagementAdmin/source/new.html.twig', array(
            'source' => $source,
            'form' => $form->createView(),
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
     * @Route("/{id}/edit", name="admin_source_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Source $source)
    {
        $deleteForm = $this->createDeleteForm($source);
        $editForm = $this->createForm('Management\AdminBundle\Form\SourceType', $source);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_source_edit', array('id' => $source->getId()));
        }

        return $this->render('@ManagementAdmin/source/edit.html.twig', array(
            'source' => $source,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a source entity.
     *
     * @Route("/{id}/delete", name="admin_source_delete")
     * Method("DELETE")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Source $source)
    {
        $em = $this->getDoctrine()->getManager();
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

        return $this->redirectToRoute('admin_source_index');
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
            ->setAction($this->generateUrl('admin_source_delete', array('id' => $source->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
