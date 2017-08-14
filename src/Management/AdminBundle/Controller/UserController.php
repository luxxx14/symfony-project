<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller
 *
 * @Route("admin/user")
 */
class UserController extends Controller {
    /**
     * Lists all user entities
     *
     * @Route("/", name="admin_user_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ManagementAdminBundle:User')
            ->createQueryBuilder('u')
            ->where('u.roles NOT LIKE :role')
            ->setParameter('role', '%ROLE_ADMIN%')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('@ManagementAdmin/user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Change subscription status of user entity depending on the requested action
     *
     * @Route("/{id}/change_subscription_status/{action}", name="admin_user_change_subscription_status",
     *     requirements={"action" = "(subscribe|unsubscribe)"})
     * @Method("GET")
     *
     * @param User $user
     * @param string $action
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changeSubscriptionStatusAction(User $user, string $action) {
        $em = $this->getDoctrine()->getManager();

        $user->setSubscribedToFeed($action == 'subscribe' ? TRUE : FALSE);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin_user_index', ['id' => $user->getId()]);
    }
}
