<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Feed;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feed controller.
 *
 * @Route("admin/feed")
 */
class FeedController extends Controller
{
    /**
     * Lists all feed entities.
     *
     * @Route("/", name="admin_feed_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $feeds = $em->getRepository('ManagementAdminBundle:Feed')
            ->createQueryBuilder('f')
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/feed/index.html.twig', array(
            'feeds' => $feeds,
        ));
    }

    /**
     * Creates a new feed entity.
     *
     * @Route("/new", name="admin_feed_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $feed = new Feed();
        $form = $this->createForm('Management\AdminBundle\Form\FeedType', $feed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feed);
            $em->flush();

            return $this->redirectToRoute('admin_feed_show', array('id' => $feed->getId()));
        }

        return $this->render('@ManagementAdmin/feed/new.html.twig', array(
            'feed' => $feed,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a feed entity.
     *
     * @Route("/{id}", name="admin_feed_show")
     * @Method("GET")
     */
    public function showAction(Feed $feed)
    {
        $deleteForm = $this->createDeleteForm($feed);

        return $this->render('@ManagementAdmin/feed/show.html.twig', array(
            'feed' => $feed,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing feed entity.
     *
     * @Route("/{id}/edit", name="admin_feed_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Feed $feed)
    {
        $deleteForm = $this->createDeleteForm($feed);
        $editForm = $this->createForm('Management\AdminBundle\Form\FeedType', $feed);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_feed_edit', array('id' => $feed->getId()));
        }

        return $this->render('@ManagementAdmin/feed/edit.html.twig', array(
            'feed' => $feed,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a feed entity.
     *
     * @Route("/{id}", name="admin_feed_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Feed $feed)
    {
        $form = $this->createDeleteForm($feed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($feed);
            $em->flush();
        }

        return $this->redirectToRoute('admin_feed_index');
    }

    /**
     * Creates a form to delete a feed entity.
     *
     * @param Feed $feed The feed entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Feed $feed)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_feed_delete', array('id' => $feed->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Change status of feed entity
     *
     * @Route("/{id}/{action}", name="admin_feed_change",
     *     requirements={"action" = "(publish|reject)"})
     * @Method("POST")
     *
     * @param Feed $feed
     * @param string $action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function changeAction(Feed $feed, string $action)
    {
        $em = $this->getDoctrine()->getManager();

        if ($action == 'publish') {
            $status = $em->getRepository('ManagementAdminBundle:FeedStatus')
                ->findOneBy(['name' => 'Опубликована']);
        }
        else {
            $status = $em->getRepository('ManagementAdminBundle:FeedStatus')
                ->findOneBy(['name' => 'Отклонена']);
        }

        $feed->setStatus($status);
        $em->persist($feed);
        $em->flush();

//        return $this->redirectToRoute('admin_feed_source_show_feed', [
//            'id' => $feed->getFeedSource()->getId()
//        ]);

        $response = new JsonResponse();
        $response->setData([
            'success' => TRUE,
            'status' => (string)$feed->getStatus(),
            'text' => $feed->getStatus() == 'Опубликована' ? 'Отклонить' : 'Опубликовать',
            'action' => $feed->getStatus() == 'Опубликована' ? 'reject' : 'publish',
            'errors' => NULL
        ]);

        return $response;
    }
}
