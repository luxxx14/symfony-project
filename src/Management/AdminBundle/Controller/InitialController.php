<?php

namespace Management\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * InitialController
 *
 * @Route("/")
 */
class InitialController extends Controller {
    /**
     * @Route("/", name="initial")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $commonInformation = $em->getRepository('ManagementAdminBundle:CommonInformation')->find(1);

        $components = $em->getRepository('ManagementAdminBundle:Component')->findAll();

        $advantages = $em->getRepository('ManagementAdminBundle:Advantage')->findAll();

        $clients = $em->getRepository('ManagementAdminBundle:Client')->findAll();

//        return $this->render('@ManagementAdmin/initial/index.html.twig');
        return $this->render('@FrontendComponents/base.html.twig', [
            'commonInformation' => $commonInformation,
            'components' => $components,
            'advantages' => $advantages,
            'clients' => $clients
        ]);
    }
}
