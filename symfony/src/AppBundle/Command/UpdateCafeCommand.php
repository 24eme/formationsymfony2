<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCafeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('update_cafe')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');
        $doctrine = $this->getContainer()->get('doctrine');
        $repository = $doctrine->getRepository("AppBundle:User");
        $nbCafe = $repository->getNbCafeGroupByUser();
        $res="";
        foreach ($nbCafe as $user) {
          $objUser=$repository->find(  array('id' => $user['id']));
          $objUser->setNbCafe($user['nbCafe']);
          $objUser->setNbPariGagne($user['nbGagne']);
          $doctrine->getManager()->persist($objUser);
          $doctrine->getManager()->flush();
          $res .= $user['username'] . ' a gagné ' . $objUser->getNbCafe(). ' cafés sur ' . $objUser->getNbPariGagne()." pari gagné!\n";
        }

        if ($input->getOption('option')) {
            // ...
        }

        $output->writeln($res);
    }


}
