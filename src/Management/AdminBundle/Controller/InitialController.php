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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Translation\LocaleBundle\Entity\Locale;

/**
 * InitialController
 *
 * @Route("/")
 */
class InitialController extends Controller {
    /**
     * @Route("/", name="initial")
     */
    public function indexAction(SessionInterface $session) {
        $locale = $session->get('locale');

        if (!$locale or !($locale instanceof Locale)) {
            $em = $this->getDoctrine()->getManager();
            $locale = $em->getRepository('TranslationLocaleBundle:Locale')->findOneBy(['selected' => TRUE]);
            $session->set('locale', $locale);
        }

        return $this->redirectToRoute('content_localize', [
            'locale' => $locale->getShortname()
        ]);
    }

    /**
     * @Route("/switch_to/{locale}/", name="switch_to_locale")
     */
    public function switchToLocaleAction(SessionInterface $session, string $locale) {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['shortname' => $locale]);
        $session->set('locale', $locale);

        return $this->redirectToRoute('content_localize', [
            'locale' => $locale->getShortname()
        ]);
    }

    /**
     * @Route("/{locale}/", name="content_localize")
     */
    public function localizeAction(string $locale) {
        $em = $this->getDoctrine()->getManager();

        $locale = $em->getRepository('TranslationLocaleBundle:Locale')
            ->findOneBy(['shortname' => $locale]);

        $locales = $em->getRepository('TranslationLocaleBundle:Locale')->findAll();

        //$fs = new Filesystem();
        //$finder = new Finder();

        $componentsPath = "https://artifactory.corchestra.ru/artifactory/list/corchestra-dev";
        $buildsPath = 'https://artifactory.corchestra.ru/artifactory/api/storage/corchestra-dev';

        $client = new \GuzzleHttp\Client();
        $response = $client->get($buildsPath);
        $buildsList = \GuzzleHttp\json_decode(strval($response->getBody()->getContents()));

        $buildsCount = count($buildsList->children);
        $newestBuildVersion = substr(strval($buildsList->children[intval($buildsCount - 1)]->uri), 1);
        $stableBuildVersion = substr(strval($buildsList->children[intval($buildsCount - 2)]->uri), 1);
        $newestBuildPath = strval($buildsPath . $buildsList->children[intval($buildsCount - 1)]->uri);
        $stableBuildPath = strval($buildsPath . $buildsList->children[intval($buildsCount - 2)]->uri);

        $builds = ['stable' => NULL, 'newest' => NULL];

        $subscriberForm = $this
            ->createForm('Management\AdminBundle\Form\SubscriberType', new Subscriber(), [
                'method' => 'POST',
                'action' => 'admin/subscriber/subscribe'
            ]);

        $texts = $em->getRepository('ManagementAdminBundle:Text')
            ->createQueryBuilder('t')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();

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
            ->findOneBy(['locale' => $locale]);

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

        $sources = $em->getRepository('ManagementAdminBundle:Source')
            ->createQueryBuilder('s')
            ->leftJoin('s.sourceLinks', 'sL')
            ->leftJoin('sL.translations', 'sLT')
            ->orderBy('s.id', 'ASC')
            ->orderBy('sLT.id', 'ASC')
            ->getQuery()
            ->getResult();

        $stable = $em->getRepository('ManagementAdminBundle:Version')->findOneBy(['type' => 'Стабильная']);
        $versions = compact('stable');

        $history = $em->getRepository('ManagementAdminBundle:VersionLinks')->findOneBy(['linkType' => 'Полная история версий']);
        $repo = $em->getRepository('ManagementAdminBundle:VersionLinks')->findOneBy(['linkType' => 'Репозиторий на Github']);
        $versionsLinks = compact('history', 'repo');

        /** Stable builds */
        $response = $client->get($stableBuildPath);
        $stableBuildsComponentsList = \GuzzleHttp\json_decode(strval($response->getBody()->getContents()));
        $createTs = strtotime(strval(substr($stableBuildsComponentsList->created, 0, strpos($stableBuildsComponentsList->created, '.'))));

        foreach ($stableBuildsComponentsList->children as $key => $dataObj) {
            $buildComponents[$key] = [
                'name' => substr(strval($dataObj->uri), 1),
                'path' => $componentsPath . '/' . $stableBuildVersion . $dataObj->uri,
                'date' => (new \DateTime())->setTimestamp($createTs)
            ];
        }

        $builds['stable'][] = [
            'name' => $stableBuildVersion,
            'path' => $componentsPath . $stableBuildsComponentsList->uri,
            'date' => substr($stableBuildsComponentsList->created, 0, 10),
            //'date' => (new \DateTime())->setTimestamp($createTs),
            'components' => $buildComponents
        ];


        /** Newest builds */
        $response = $client->get($newestBuildPath);
        $newestBuildsComponentsList = \GuzzleHttp\json_decode(strval($response->getBody()->getContents()));
        $createTs = strtotime(strval(substr($newestBuildsComponentsList->created, 0, strpos($newestBuildsComponentsList->created, '.'))));

        foreach ($newestBuildsComponentsList->children as $key => $dataObj) {
            $buildComponents[$key] = [
                'name' => substr(strval($dataObj->uri), 1),
                'path' => $componentsPath . '/' . $newestBuildVersion . $dataObj->uri,
                'date' => (new \DateTime())->setTimestamp($createTs)
            ];
        }

        $builds['newest'][] = [
            'name' => $newestBuildVersion,
            'path' => $componentsPath . $newestBuildsComponentsList->uri,
            'date' => substr($newestBuildsComponentsList->created, 0, 10),
            //'date' => (new \DateTime())->setTimestamp($createTs),
            'components' => $buildComponents
        ];


        return $this->render('@FrontendComponents/base.html.twig', [
            'locale' => $locale,
            'locales' => $locales,
            'texts' => $texts,
            'commonInformation' => $commonInformation,
            'companyInformation' => $companyInformation,
            'components' => $components,
            'advantages' => $advantages,
            'clients' => $clients,
            'selectedFeedSource' => $selectedFeedSource,
            'feed' => $feed,
            'versions' => $versions,
            'versionsLinks' => $versionsLinks,
            'builds' => $builds,
            'sources' => $sources,
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

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 || (substr($haystack, -$length) === $needle);
    }
}
