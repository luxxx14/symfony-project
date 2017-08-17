<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\CompanyInformation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Companyinformation controller.
 *
 * @Route("admin/company_information")
 */
class CompanyInformationController extends Controller
{
    /**
     * Lists all companyInformation entities.
     *
     * @Route("/", name="admin_company_information_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $companyInformation = $em->getRepository('ManagementAdminBundle:CompanyInformation')
            ->createQueryBuilder('cI')
            ->orderBy('cI.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/companyinformation/index.html.twig', array(
            'companyInformation' => $companyInformation,
        ));
    }

    /**
     * Creates a new companyInformation entity.
     *
     * @Route("/new", name="admin_company_information_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $companyInformation = new Companyinformation();
        $form = $this->createForm('Management\AdminBundle\Form\CompanyInformationType', $companyInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($companyInformation);
            $em->flush();

            return $this->redirectToRoute('admin_company_information_show', array('id' => $companyInformation->getId()));
        }

        return $this->render('@ManagementAdmin/companyinformation/new.html.twig', array(
            'companyInformation' => $companyInformation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a companyInformation entity.
     *
     * @Route("/{id}", name="admin_company_information_show")
     * @Method("GET")
     */
    public function showAction(CompanyInformation $companyInformation)
    {
        $deleteForm = $this->createDeleteForm($companyInformation);

        return $this->render('@ManagementAdmin/companyinformation/show.html.twig', array(
            'companyInformation' => $companyInformation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing companyInformation entity.
     *
     * @Route("/{id}/edit", name="admin_company_information_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CompanyInformation $companyInformation)
    {
        $deleteForm = $this->createDeleteForm($companyInformation);
        $editForm = $this->createForm('Management\AdminBundle\Form\CompanyInformationType', $companyInformation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_company_information_edit', array('id' => $companyInformation->getId()));
        }

        return $this->render('@ManagementAdmin/companyinformation/edit.html.twig', array(
            'companyInformation' => $companyInformation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a companyInformation entity.
     *
     * @Route("/{id}", name="admin_company_information_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CompanyInformation $companyInformation)
    {
        $form = $this->createDeleteForm($companyInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($companyInformation);
            $em->flush();
        }

        return $this->redirectToRoute('admin_company_information_index');
    }

    /**
     * Creates a form to delete a companyInformation entity.
     *
     * @param CompanyInformation $companyInformation The companyInformation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CompanyInformation $companyInformation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_company_information_delete', array('id' => $companyInformation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
