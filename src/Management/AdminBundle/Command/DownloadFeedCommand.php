<?php

namespace Management\AdminBundle\Command;

use DateTime;
use Management\AdminBundle\Entity\Feed;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class DownloadFeedCommand extends ContainerAwareCommand {
    protected function configure() {
        $this
            ->setName('download:feed')
            ->setDescription('Download feed')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $modifiedSince = new \DateTime('2015-01-01');

        $feedIo = $this->getContainer()->get('feedio');

        $feedSource = $em->getRepository('ManagementAdminBundle:FeedSource')
            ->findOneBy(['selected' => TRUE]);

        /** Now fetch its (fresh) content */
        $feed = $feedIo->readSince($feedSource->getUrl(), $modifiedSince)->getFeed();

        foreach ($feed as $item) {
            $loadedItem = $em->getRepository('ManagementAdminBundle:Feed')->findOneBy(['link' => $item->getLink()]);

            if (!$loadedItem) {
                $feed = new Feed(
                    $item->getPublicId(),
                    $item->getTitle(),
                    $item->getDescription(),
                    $item->getAuthor()->getName(),
                    $item->getLastModified(),
                    $item->getLink(),
                    $feedSource,
                    $em->getRepository('ManagementAdminBundle:FeedStatus')->findOneBy(['name' => 'На модерации'])
                );

                $em->persist($feed);
                $em->flush();
            }
        }

        $output->writeln('Task completed!');
    }
}
