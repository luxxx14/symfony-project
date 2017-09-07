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

        $sources = $em->getRepository('ManagementAdminBundle:Source')
            ->createQueryBuilder('s')
            ->leftJoin('s.sourceLinks', 'sL')
            ->orderBy('s.id', 'ASC')
            ->orderBy('sL.id', 'ASC')
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
                    $buildComponents = [];

                    $buildName = '';

                    $componentsFinder = new Finder();

                    $componentsPath = substr($file->getFilename(), 33, strlen($file->getFilename()) - 33 - 4);
//                    $componentsPath = str_replace('-', '_', $componentsPath);
                    if ($fs->exists($buildsPath . 'stable/' . $componentsPath)) {
                        $componentsFinder->files()->in($buildsPath . 'stable/' . $componentsPath);
                        $componentsFinder->sortByName();

                        foreach ($componentsFinder as $componentFile) {
                            $buildComponents[] = [
                                'name' => $componentFile->getFilename(),
                                'path' => '/download/builds/stable/' . $componentsPath . '/' . $componentFile->getFilename(),
                                'date' => (new \DateTime())->setTimestamp($componentFile->getATime())
                            ];

                            if ($componentFile->getFilename() == 'platformversion.info') {
                                $platformVersionInfo = explode(PHP_EOL, $componentFile->getContents());
//                                $platformVersionInfo = file_get_contents($componentFile);
//                                $platformVersionInfo = preg_replace('/\s+/', '', $platformVersionInfo);
//                                $arr = json_decode($platformVersionInfo, true);

                                $versionNumber = substr($platformVersionInfo[2], 9, strlen($platformVersionInfo[2]) - 9);
                                $buildNumber = substr($platformVersionInfo[4], 14, strlen($platformVersionInfo[4]) - 14);

                                $buildName = 'Course Orchestra v' . $versionNumber . ' Build ' . $buildNumber;
                            }
                        }
                    }

                    unset($componentsFinder);

                    $builds['stable'][] = [
                        'name' => $buildName,
                        'path' => '/download/builds/stable/' . $file->getFilename(),
                        'date' => (new \DateTime())->setTimestamp($file->getATime()),
                        'components' => $buildComponents
                    ];

                    unset($buildComponents);
                }
            }
            if (array_key_exists('stable', $builds) and $builds['stable']) {
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
                    $buildComponents = [];

                    $buildName = '';

                    $componentsFinder = new Finder();

                    $componentsPath = substr($file->getFilename(), 32, strlen($file->getFilename()) - 32 - 4);
//                    $componentsPath = str_replace('-', '_', $componentsPath);
                    if ($fs->exists($buildsPath . 'trunk/' . $componentsPath)) {
                        $componentsFinder->files()->in($buildsPath . 'trunk/' . $componentsPath);
                        $componentsFinder->sortByName();

                        foreach ($componentsFinder as $componentFile) {
                            $buildComponents[] = [
                                'name' => $componentFile->getFilename(),
                                'path' => '/download/builds/trunk/' . $componentsPath . '/' . $componentFile->getFilename(),
                                'date' => (new \DateTime())->setTimestamp($componentFile->getATime())
                            ];

                            if ($componentFile->getFilename() == 'platformversion.info') {
                                $platformVersionInfo = explode(PHP_EOL, $componentFile->getContents());
//                                $platformVersionInfo = file_get_contents($componentFile);
//                                $platformVersionInfo = preg_replace('/\s+/', '', $platformVersionInfo);
//                                $arr = json_decode($platformVersionInfo, true);

                                $versionNumber = substr($platformVersionInfo[2], 9, strlen($platformVersionInfo[2]) - 9);
                                $buildNumber = substr($platformVersionInfo[4], 14, strlen($platformVersionInfo[4]) - 14);

                                $buildName = 'Course Orchestra v' . $versionNumber . ' Build ' . $buildNumber;
                            }
                        }
                    }

                    unset($componentsFinder);

                    $builds['newest'][] = [
                        'name' => $buildName,
                        'path' => '/download/builds/trunk/' . $file->getFilename(),
                        'date' => (new \DateTime())->setTimestamp($file->getATime()),
                        'components' => $buildComponents
                    ];
                }
            }
            if (array_key_exists('newest', $builds) and $builds['newest']) {
                rsort($builds['newest']);
            }
        }

        return $this->render('@FrontendComponents/base.html.twig', [
            'locale' => $locale,
            'locales' => $locales,
            'commonInformation' => $commonInformation,
            'companyInformation' => $companyInformation,
            'components' => $components,
            'advantages' => $advantages,
            'clients' => $clients,
            'selectedFeedSource' => $selectedFeedSource,
            'feed' => $feed,
            'versions' => $versions,
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
