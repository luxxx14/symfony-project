<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\VersionLinks;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Versionlink controller.
 *
 * @Route("admin/versionlinks")
 */
class VersionLinksController extends Controller
{
    /**
     * Lists all versionLink entities.
     *
     * @Route("/", name="admin_versionlinks_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $versionLinks = $em->getRepository('ManagementAdminBundle:VersionLinks')
            ->findAll();

        return $this->render('@ManagementAdmin/versionlinks/index.html.twig', array(
            'versionLinks' => $versionLinks,
        ));
    }

    /**
     * Displays a form to edit an existing versionLinks entity.
     *
     * @Route("/{id}/edit", name="admin_versionlinks_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VersionLinks $versionLinks)
    {
        //$deleteForm = $this->createDeleteForm($versionLinks);
        $editForm = $this->createForm('Management\AdminBundle\Form\VersionLinks', $versionLinks);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_versionlinks_index');
        }

        return $this->render('@ManagementAdmin/versionlinks/edit.html.twig', array(
            '$versionLinks' => $versionLinks,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a versionLink entity.
     *
     * @Route("/{id}", name="admin_show")
     * @Method("GET")
     */
    public function showAction(VersionLinks $versionLink)
    {

        return $this->render('versionlinks/show.html.twig', array(
            'versionLink' => $versionLink,
        ));
    }
}
