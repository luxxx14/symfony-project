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

        $components = $em->getRepository('ManagementAdminBundle:Component')
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        $advantages = $em->getRepository('ManagementAdminBundle:Advantage')
            ->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();

        $clients = $em->getRepository('ManagementAdminBundle:Client')
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        $selectedFeedSource = $em->getRepository('ManagementAdminBundle:FeedSource')
            ->findOneBy(['selected' => TRUE]);
        $feed = $em->getRepository('ManagementAdminBundle:Feed')
            ->createQueryBuilder('f')
            ->where('f.status = :status')
            ->andWhere('f.feedSource = :feedSource')
            ->setParameter('status', 'Опубликована')
            ->setParameter('feedSource', $selectedFeedSource)
            ->orderBy('f.status', 'ASC')
            ->orderBy('f.lastModified', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        $stable = $em->getRepository('ManagementAdminBundle:Version')->findOneBy(['type' => 'Стабильная']);
        $newest = $em->getRepository('ManagementAdminBundle:Version')->findOneBy(['type' => 'Новейшая']);
        $source = $em->getRepository('ManagementAdminBundle:Version')->findOneBy(['type' => 'Исходный код']);

        $versions = compact('stable', 'newest', 'source');

//        return $this->render('@ManagementAdmin/initial/index.html.twig');
        return $this->render('@FrontendComponents/base.html.twig', [
            'commonInformation' => $commonInformation,
            'components' => $components,
            'advantages' => $advantages,
            'clients' => $clients,
            'feed' => $feed,
            'versions' => $versions
        ]);
    }
}
