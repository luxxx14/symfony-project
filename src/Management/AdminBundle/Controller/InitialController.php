<?php

namespace Management\AdminBundle\Controller;

use Management\AdminBundle\Entity\Subscriber;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
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

        $fs = new Filesystem();

        $finder = new Finder();
        $buildsPath = $this->get('kernel')->getRootDir() . '/../web/download/builds/';
        $builds = ['stable' => NULL, 'newest' => NULL];

        $subscriberForm = $this
            ->createForm('Management\AdminBundle\Form\SubscriberType', new Subscriber(), [
                'method' => 'POST',
                'action' => 'admin/subscriber/subscribe'
            ]);

        $commonInformation = $em->getRepository('ManagementAdminBundle:CommonInformation')->find(1);

        $companyInformation = $em->getRepository('ManagementAdminBundle:CompanyInformation')->find(1);

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

        if ($fs->exists($buildsPath . 'stable')) {
            /** Stable builds */
            $finder->files()->in($buildsPath . 'stable');
            $finder->sortByName();

            $count = $finder->count();
            $current = 0;
            foreach ($finder as $file) {
                $current++;

                if ($count - $current <= 3) {
                    $builds['stable'][] = [
                        'name' => $file->getFilename(),
                        'path' => $file->getRealPath(),
                        'date' => (new \DateTime())->setTimestamp($file->getATime())
                    ];
                }
            }
            if (array_key_exists('stable', $builds)) {
                rsort($builds['stable']);
            }
        }
        if ($fs->exists($buildsPath . 'trunk')) {
            /** Newest builds */
            $finder->files()->in($buildsPath . 'trunk');
            $finder->sortByName();

            $count = $finder->count();
            $current = 0;
            foreach ($finder as $file) {
                $current++;

                if ($count - $current <= 3) {
                    $builds['newest'][] = [
                        'name' => $file->getFilename(),
                        'path' => $file->getRealPath(),
                        'date' => (new \DateTime())->setTimestamp($file->getATime())
                    ];
                }
            }
            if (array_key_exists('newest', $builds)) {
                rsort($builds['newest']);
            }
        }

        return $this->render('@FrontendComponents/base.html.twig', [
            'commonInformation' => $commonInformation,
            'companyInformation' => $companyInformation,
            'components' => $components,
            'advantages' => $advantages,
            'clients' => $clients,
            'feed' => $feed,
            'versions' => $versions,
            'builds' => $builds,
            'subscriberForm' => $subscriberForm->createView()
        ]);
    }

//    /**
//     * @Route("/", name="initial")
//     */
//    public function downloadAction() {
//        $path = $this->get('kernel')->getRootDir(). "/../web/download/builds/";
//        $content = file_get_contents($path . 'stable/5.1_build518');
//
//        $response = new Response();
//
//        //set headers
//        $response->headers->set('Content-Type', 'mime/type');
//        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);
//
//        $response->setContent($content);
//        return $response;
//    }
}
