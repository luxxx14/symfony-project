<?php

namespace Management\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * MainController
 *
 * @Route("/admin")
 */
class MainController extends Controller {
    /**
     * @Route("/index", name="admin_index")
     */
    public function indexAction() {
        return $this->render('@ManagementAdmin/main/index.html.twig');
    }
}
