<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\User;
use Management\AdminBundle\Toolkit\CropImageToSquare;
use Management\AdminBundle\Toolkit\ImageHandler;
use SocialNetwork\TournamentsBundle\Entity\SubscriptionsPaymentHistory;
use SocialNetwork\TournamentsBundle\Entity\UsersSubscriptions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller {
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ManagementAdminBundle:User')->findAll();

        return $this->render('@ManagementAdmin/user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $user = new User();
        $form = $this->createForm('Management\AdminBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('@ManagementAdmin/user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="user_show")
     * @Method("GET")
     */
    public function showAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em
            ->getRepository('SocialNetworkTournamentsBundle:Tournament')
            ->createQueryBuilder('t')
            ->leftJoin('t.games', 'g')
            ->where('g.participant1 = :user OR g.participant2 = :user')
            ->setParameter('user', $user)
            ->orderBy('t.id', 'ASC')
            ->orderBy('g.roundNumber', 'ASC')
            ->getQuery();

//        $query = $qb->getQuery();

        $paginator  = $this->get('knp_paginator');
        $userTournaments = $paginator->paginate(/*$pagination = $paginator->paginate(*/
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/,
            ['wrap-queries' => true]
        );

        $deleteForm = $this->createDeleteForm($user);

//        $currentUserSubscription = $em->getRepository('SocialNetworkTournamentsBundle:UsersSubscriptions')
//            ->getCurrentUserSubscription($user);

        return $this->render('@ManagementAdmin/user/show.html.twig', array(
            'user' => $user,
//            'userSubscription' => $currentUserSubscription,
            'pagination' => $userTournaments,
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $errorMessage = NULL;
        $deleteForm = $this->createDeleteForm($user);

        $editForm = $this
            ->createForm('Management\AdminBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $currentPlainPassword = $editForm->get('currentPlainPassword')->getData();
            if (!empty($currentPlainPassword)) {
                $encoder = $this->get('security.password_encoder');
//                var_dump($encoder->isPasswordValid($user, $currentPlainPassword));
                if (password_verify($currentPlainPassword, $user->getPassword())) {
//                if ($encoder->isPasswordValid($user, $currentPlainPassword)) {
                    /**
                     * Encode the inputted user's plain password and compare it with real current user's password
                     */
                    $user->setPassword($encoder->encodePassword($user, $user->getPlainPassword()));
                    /**
                     * Clear plain password
                     */
                    $user->setPlainPassword(NULL);
                }
                else {
                    $errorMessage = 'Текущий пароль указан неверно';
                }
            }
            else {
                if (!empty($editForm->get('plainPassword')->getData())) {
                    $errorMessage = 'Текущий пароль не указан';
                }
            }

            /**
             * Check if availability fields are correctly
             */
            if ($user->getAWeekdaysFrom() && $user->getAWeekdaysTo() &&
                $user->getAWeekdaysFrom() > $user->getAWeekdaysTo()) {
                $bufferValue = $user->getAWeekdaysFrom();
                $user->setAWeekdaysFrom($user->getAWeekdaysTo());
                $user->setAWeekdaysTo($bufferValue);
            }

            if ($user->getAWeekendFrom() && $user->getAWeekendTo() &&
                $user->getAWeekendFrom() > $user->getAWeekendTo()) {
                $bufferValue = $user->getAWeekendFrom();
                $user->setAWeekendFrom($user->getAWeekendTo());
                $user->setAWeekendTo($bufferValue);
            }

            /**
             * Set date of change
             */
            $user->setDateOfChange(new \DateTime('NOW'));

            if (!$errorMessage) {
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();

                /**
                 * If image profile is exists - no matter where it was loaded from - resize it with 'crop' option
                 */
                if ($user->getProfileImageName()) {
                    $path = $this->get('kernel')->getRootDir() . '/../web/uploads/images/user_profile/' . $user->getProfileImageName();
                    $resizeObj = new ImageHandler($path);

                    /**
                     * Resize image (options: exact, portrait, landscape, auto, crop)
                     */
                    $resizeObj->resizeImage(200, 200, 'crop');

                    /**
                     * Save image ('image-name', 'quality [int]')
                     */
                    $resizeObj->saveImage($path, 100);
                }

                return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
            }
        }

        return $this->render('@ManagementAdmin/user/edit.html.twig', array(
            'currentPlainPassword' => $request,
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'error_message' => $errorMessage
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", requirements={"id" = "\d+"}, name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Send an invitation to another user
     *
     * @Route("/{id}/send_invitation", name="send_invitation")
     * @Method("GET")
     *
     * @param Request $request
     * @param User $receiver
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendInvitationAction(Request $request, User $receiver)
    {
        $sender = $this->getUser();

        $senderFullName = $sender->getFirstName() . ' ' . $sender->getLastName();

        $mailer = $this->get('mailer');

        $message = $mailer->createMessage()
            ->setSubject('Tennison. New invitation.')
            ->setFrom('notify@tennison.ru')
            ->setTo($receiver->getEmail())
            ->setBody(
                $this->renderView(
                    '@ManagementAdmin/user/invitation.html.twig', [
                    'sender_full_name' => $senderFullName,
                    'sender_email' => $sender->getEmail()
                ]),
                'text/html'
            );

        $mailer->send($message);

        return $this->render('@ManagementAdmin/user/after_invitation.html.twig');
    }

    /**
     * Lists all notification of the user
     *
     * @Route("/{id}/notifications", name="user_notifications")
     * @Method("GET")
     *
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showNotificationsAction(Request $request, User $user)
    {
        $qb = $this->getDoctrine()
            ->getRepository('SocialNetworkTournamentsBundle:Notification')->createQueryBuilder('n');

        $qb
            ->where('n.user = :user')
            ->setParameter('user', $user->getId())
            ->orderBy('n.id', 'DESC');

        $query = $qb->getQuery();

        $paginator  = $this->get('knp_paginator');
        $notifications = $paginator->paginate(/*$pagination = $paginator->paginate(*/
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            30/*limit per page*/
        );

        return $this->render('@SocialNetworkTournaments/notification/index.html.twig', array(
            'notifications' => $notifications,
        ));
    }

    /**
     * Show the subscription payment
     *
     * @Route("/show_subscription_payment", name="user_show_subscription_payment")
     * @Route("/show_subscription_payment/{id}/{status}",
     *   requirements={"id" = "\d+", "status" = "(success|fail)"},
     *   name="user_show_subscription_payment_status")
     * @Method({"GET", "POST"})
     *
     * @param string $id
     * @param string $status
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showSubscriptionPaymentAction(string $id = null, string $status = 'add') {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $userSubscription = $em->getRepository('SocialNetworkTournamentsBundle:UserSubscription')
            ->findOneBy(['user' => $user]);
        $subscriptionPayment = $em->getRepository('SocialNetworkTournamentsBundle:Payment')
            ->findOneBy(['name' => 'Подписка Tennison, 1 год']);

        $paymentEntry = new SubscriptionsPaymentHistory($user, $subscriptionPayment);
//        $user->addPaymentTransaction($paymentEntry);
        $em->persist($paymentEntry);
//        $em->persist($user);
        $em->flush();

//        if ($status == 'add') {
//            $yandexKassaParams = [
//                'shopId' => $this->getParameter('yandex_kassa.shop_id'),
//                'scid' => $this->getParameter('yandex_kassa.sc_id'),
//                'test' => $this->getParameter('yandex_kassa.test'),
//            ];
//        } elseif ($id) {
//            $userSubscription = $em->getRepository('SocialNetworkTournamentsBundle:UsersSubscriptions')
//                ->find($id);
//        }
        $yandexKassaParams = [
            'shopId' => $this->getParameter('yandex_kassa.shop_id'),
            'scid' => $this->getParameter('yandex_kassa.sc_id'),
            'test' => $this->getParameter('yandex_kassa.test'),
        ];

        return $this->render(
            '@ManagementAdmin/user/show_subscription_payment.html.twig',
            compact('user', 'status', 'userSubscription', 'subscriptionPayment', 'paymentEntry', 'yandexKassaParams')
        );
    }

    /**
     * Reject the subscription payment
     *
     * @Route("/reject_subscription_payment/{id}", name="user_reject_subscription_payment")
     * @Method({"GET", "POST"})
     *
     * @param SubscriptionsPaymentHistory $paymentEntry
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rejectSubscriptionPaymentAction(SubscriptionsPaymentHistory $paymentEntry) {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        if ($paymentEntry->getUser() == $user &&
            $paymentEntry->getStatus() == SubscriptionsPaymentHistory::STATUS_NEW) {
            $em->remove($paymentEntry);
            $em->flush();
        }

        return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
    }
}