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

class ChangeAdminPasswordCommand extends ContainerAwareCommand {
    protected function configure() {
        $this
            ->setName('change-admin-user-password')
            ->setDescription('Changes the password for system administrator')
            ->addArgument(
                'new password',
                InputArgument::REQUIRED,
                'What password do you want the administrative account to have?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $encoder = $this->getContainer()->get('security.password_encoder');

        $newPassword = $input->getArgument('new password');

        $adminAccount = $em->getRepository('ManagementAdminBundle:User')->findAdminAccount();

        /**
         * 'SUCCESS' style
         */
        $successStyle = new OutputFormatterStyle('white', 'green');
        $output->getFormatter()->setStyle('success', $successStyle);

        /**
         * Declaring the formatter
         */
        $formatter = $this->getHelper('formatter');

        if ($adminAccount) {
            /**
             * Encode the inputted user's plain password and compare it with real current user's password
             */
            $password = $encoder->encodePassword($adminAccount, $newPassword);
            $adminAccount->setPassword($password);

            $em->persist($adminAccount);
            $em->flush();

            /**
             * The output to the console
             */
            $message = array('INFO:', 'Password for admin account was successfully updated!');
            $formattedInfoBlock = $formatter->formatBlock($message, 'info', TRUE);
            $output->writeln($formattedInfoBlock);
        }
        else {
            /**
             * The output to the console
             */
            $message = array('INFO:', 'Nothing to update...');
            $formattedInfoBlock = $formatter->formatBlock($message, 'info', TRUE);
            $output->writeln($formattedInfoBlock);
        }
    }
}
