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
class FeedsController extends Controller {
    /**
     * @Route("/feeds", name="admin_feeds")
     */
    public function readAction() {
        $feedIo = $this->container->get('feedio');

        /** This date is used to fetch only the latest items */
        $modifiedSince = new \DateTime('2011-01-01');

        /** The feed you want to read */
        $url = 'https://groups.google.com/forum/feed/curs-group/msgs/rss.xml';

//        $feed = $feedIo->read($url, new \Acme\Entity\Feed, $modifiedSince)->getFeed();
//
//        foreach ( $feed as $item ) {
//            echo "item title : {$item->getTitle()} \n ";
//            // getMedias() returns enclosures if any
//            $medias = $item->getMedias();
//        }

        /** Now fetch its (fresh) content */
        $feed = $feedIo->readSince($url, $modifiedSince)->getFeed();

        return $this->render('@ManagementAdmin/feeds/index.html.twig', [
            'feed' => $feed
        ]);
    }
}
