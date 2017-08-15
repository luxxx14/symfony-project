<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GenerationController
 *
 * @Route("admin/generation")
 */
class GenerationController extends Controller {
    /**
     * @Route("/index", name="generation_index")
     */
    public function indexAction() {
        return $this->render('@ManagementAdmin/generation/index.html.twig');
    }

    /**
     * @Route("/users", name="generate_users")
     */
    public function generateUsersAction() {
        $em = $this->getDoctrine()->getManager();
        
        for ($iterator = 0; $iterator < 8; $iterator++) {
            $user = new User();

            $username = $this->generateRandomString(8);

            $domains = ['.ru', '.com', '.org', '.im', '.io', '.net', '.su', '.pro', '.tech'];

            $email = $this->generateRandomString() .
                '@' . $this->generateRandomString(6) . $domains[array_rand($domains, 1)];

            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPlainPassword($this->generateRandomString(8));
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->addRole('ROLE_USER');

            $user->setEnabled(TRUE);
            $em->persist($user);
            $em->flush();
        }

        return $this->redirectToRoute('admin_user_index');
    }

    public function generateRandomString($maxLength = 15) {
        $randomLength = mt_rand(3, $maxLength);
        $string = "";
        $characters = array_merge(range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $randomLength; $i++) {
            $rand = mt_rand(0, $max);
            $string .= $characters[$rand];
        }
        return $string;
    }
}
