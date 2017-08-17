<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Subscriber;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subscriber controller
 *
 * @Route("admin/subscriber")
 */
class SubscriberController extends Controller
{
    /**
     * Lists all subscriber entities
     *
     * @Route("/", name="admin_subscriber_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $subscribers = $em->getRepository('ManagementAdminBundle:Subscriber')
            ->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/subscriber/index.html.twig', array(
            'subscribers' => $subscribers,
        ));
    }

    /**
     * Change subscription status of subscriber entity depending on the requested action
     *
     * @Route("/{id}/change_subscription_status/{action}", name="admin_subscriber_change_subscription_status",
     *     requirements={"action" = "(subscribe|unsubscribe)"})
     * @Method("GET")
     *
     * @param Subscriber $subscriber
     * @param string $action
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changeSubscriptionStatusAction(Subscriber $subscriber, string $action) {
        $em = $this->getDoctrine()->getManager();

        $subscriber->setSubscribedToFeed($action == 'subscribe' ? TRUE : FALSE);
        $em->persist($subscriber);
        $em->flush();

        return $this->redirectToRoute('admin_subscriber_index', ['id' => $subscriber->getId()]);
    }

    /**
     * Subscribe action
     *
     * @Route("/{email}/subscribe", name="admin_subscriber_subscribe")
     * @Method("POST")
     */
    public function subscribeAction(string $email) {
        $em = $this->getDoctrine()->getManager();

        $existingSubscriber = $em->getRepository('ManagementAdminBundle:Subscriber')
            ->findOneBy(['email' => $email]);
        if (!$existingSubscriber) {
            $subscriber = new Subscriber();
            $subscriber->setEmail($email);

            $em->persist($subscriber);
            $em->flush();
        }

        return $this->redirectToRoute('initial');
    }

//    /**
//     * Subscribe action
//     *
//     * @Route("/subscribe", name="admin_subscriber_subscribe")
//     * @Method("POST")
//     */
//    public function subscribeAction(Request $request/*string $email*/) {
//        $em = $this->getDoctrine()->getManager();
//
//        $subscriberForm = $this
//            ->createForm('Management\AdminBundle\Form\SubscriberType', new Subscriber(), [
//                'method' => 'POST',
//                'action' => 'admin/subscriber/subscribe'
//            ]);
//
//        $subscriberForm->handleRequest($request);
//
//        if ($subscriberForm->isSubmitted() && $subscriberForm->isValid()) {
//            $email = $subscriberForm->get('email')->getData();
//
//            $existingSubscriber = $em->getRepository('ManagementAdminBundle:Subscriber')
//                ->findOneBy(['email' => $email]);
//            if (!$existingSubscriber) {
//                $subscriber = new Subscriber();
//                $subscriber->setEmail($email);
//
//                $em->persist($subscriber);
//                $em->flush();
//            }
//        }
//
//        $response = new JsonResponse();
//        $response->setData([]);
//
//        return $response;
//    }
}
