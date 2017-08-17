<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Advantage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

/**
 * Advantage controller.
 *
 * @Route("admin/advantage")
 */
class AdvantageController extends Controller
{
    /**
     * Lists all advantage entities.
     *
     * @Route("/", name="admin_advantage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $advantages = $em->getRepository('ManagementAdminBundle:Advantage')
            ->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/advantage/index.html.twig', array(
            'advantages' => $advantages,
        ));
    }

    /**
     * Creates a new advantage entity.
     *
     * @Route("/new", name="admin_advantage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $advantage = new Advantage();
        $form = $this->createForm('Management\AdminBundle\Form\AdvantageType', $advantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advantage);
            $em->flush();

            return $this->redirectToRoute('admin_advantage_index');
        }

        return $this->render('@ManagementAdmin/advantage/new.html.twig', array(
            'advantage' => $advantage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a advantage entity.
     *
     * @Route("/{id}", name="admin_advantage_show")
     * @Method("GET")
     */
    public function showAction(Advantage $advantage)
    {
        $deleteForm = $this->createDeleteForm($advantage);

        return $this->render('@ManagementAdmin/advantage/show.html.twig', array(
            'advantage' => $advantage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing advantage entity.
     *
     * @Route("/{id}/edit", name="admin_advantage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Advantage $advantage)
    {
        $deleteForm = $this->createDeleteForm($advantage);
        $editForm = $this->createForm('Management\AdminBundle\Form\AdvantageType', $advantage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $fs = new Filesystem();
//
//            $path = $this->get('kernel')->getRootDir() . '/../web/uploads/images/advantage';
//
//            $fs->chmod($path, 0777);

            $this->getDoctrine()->getManager()->flush();

//            $fs->chmod($path, 0755);

            return $this->redirectToRoute('admin_advantage_index');
        }

        return $this->render('@ManagementAdmin/advantage/edit.html.twig', array(
            'advantage' => $advantage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a advantage entity.
     *
     * @Route("/{id}", name="admin_advantage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Advantage $advantage)
    {
        $form = $this->createDeleteForm($advantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advantage);
            $em->flush();
        }

        return $this->redirectToRoute('admin_advantage_index');
    }

    /**
     * Creates a form to delete a advantage entity.
     *
     * @param Advantage $advantage The advantage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Advantage $advantage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_advantage_delete', array('id' => $advantage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
