<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\CommonInformation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commoninformation controller.
 *
 * @Route("admin/common_information")
 */
class CommonInformationController extends Controller
{
    /**
     * Lists all commonInformation entities.
     *
     * @Route("/", name="admin_common_information_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commonInformation = $em->getRepository('ManagementAdminBundle:CommonInformation')
            ->createQueryBuilder('cI')
            ->orderBy('cI.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/commoninformation/index.html.twig', array(
            'commonInformation' => $commonInformation,
        ));
    }

    /**
     * Creates a new commonInformation entity.
     *
     * @Route("/new", name="admin_common_information_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $commonInformation = new Commoninformation();
        $form = $this->createForm('Management\AdminBundle\Form\CommonInformationType', $commonInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commonInformation);
            $em->flush();

            return $this->redirectToRoute('admin_common_information_show', array('id' => $commonInformation->getId()));
        }

        return $this->render('@ManagementAdmin/commoninformation/new.html.twig', array(
            'commonInformation' => $commonInformation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commonInformation entity.
     *
     * @Route("/{id}", name="admin_common_information_show")
     * @Method("GET")
     */
    public function showAction(CommonInformation $commonInformation)
    {
        $deleteForm = $this->createDeleteForm($commonInformation);

        return $this->render('@ManagementAdmin/commoninformation/show.html.twig', array(
            'commonInformation' => $commonInformation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commonInformation entity.
     *
     * @Route("/{id}/edit", name="admin_common_information_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CommonInformation $commonInformation)
    {
        $deleteForm = $this->createDeleteForm($commonInformation);
        $editForm = $this->createForm('Management\AdminBundle\Form\CommonInformationType', $commonInformation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_common_information_index');
        }

        return $this->render('@ManagementAdmin/commoninformation/edit.html.twig', array(
            'commonInformation' => $commonInformation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commonInformation entity.
     *
     * @Route("/{id}", name="admin_common_information_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CommonInformation $commonInformation)
    {
        $form = $this->createDeleteForm($commonInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commonInformation);
            $em->flush();
        }

        return $this->redirectToRoute('admin_common_information_index');
    }

    /**
     * Creates a form to delete a commonInformation entity.
     *
     * @param CommonInformation $commonInformation The commonInformation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommonInformation $commonInformation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_common_information_delete', array('id' => $commonInformation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
