<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\User;
use Management\AdminBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * SecurityController
 *
 * @Route("/admin")
 */
class SecurityController extends Controller {
    /**
     * @Route("/", name="admin_login")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request) {
        return $this->render('@ManagementAdmin/register/login.html.twig');
    }

    /**
     * @Route("/registration", name="admin_registration")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registrationAction(Request $request) {
        /**
         * Create a new blank user and process the form
         */
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * Encode the new user's password
             */
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            /**
             * Set user as active
             */
            $user->setEnabled(TRUE);

            /**
             * Assign ROLE_ADMIN role
             */
            $user->addRole('ROLE_ADMIN');

            /**
             * Set date of creation and assume that this user just has also been changed
             */
            $dateOfCreation = new \DateTime('NOW');
            $user->setDateOfCreation($dateOfCreation);
            $user->setDateOfChange($dateOfCreation);

            /**
             * Save
             */
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            /**
             * Assign ROLE_ADMIN role
             */
            $user->addRole('ROLE_ADMIN');
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('@ManagementAdmin/register/register.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

//    public function loginAction(Request $request) {
//        $helper = $this->get('security.authentication_utils');
//
//        $form = $this->createFormBuilder()
//            ->add('email', EmailType::class, array(
//                'label' => false,
//                'label_attr' => [
//                    'class' => 'control-label'
//                ],
//                'required' => true,
//                'attr' => [
//                    'placeholder' => 'E-mail',
//                    'class' => 'form-control'
//                ],
//            ))
//            ->getForm();
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $data = $form->getData();
//            $email = $data['email'];
//
//            $em = $this->getDoctrine()->getManager();
//            $user = $em->getRepository('ManagementAdminBundle:User')->findOneBy(['email' => $email]);
//
//            if ($user) {
//
//                return $this->render(
//                    '@ManagementAdmin/register/login.html.twig',
//                    array(
//                        'last_email'    => $helper->getLastUsername(),
//                        'error'         => $helper->getLastAuthenticationError(),
//                        'form'          => $form->createView(),
//                        'user'          => $user
//                    )
//                );
//            }
//        }
//
//        return $this->render(
//            '@ManagementAdmin/register/login.html.twig',
//            array(
//                'last_email'    => $helper->getLastUsername(),
//                'error'         => $helper->getLastAuthenticationError(),
//                'form'          => $form->createView()
//            )
//        );
//    }
//
    /**
     * @Route("/login_check", name="login_check")
     */
    public function checkAction() {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction() {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}