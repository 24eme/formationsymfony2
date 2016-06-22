<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppMeilleurPronostiqueurCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:meilleur-pronostiqueur')
            ->setDescription('Determiner le meilleur pronostiqueur')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $argument = $input->getArgument('argument');

        // if ($input->getOption('option')) {
            // ...

        //}

        $gd = $this->getContainer()->get('doctrine')->getRepository("AppBundle:User");

        $pronostics = $gd->getMeilleurPronostiqueur();

        foreach ($pronostics as $pronostic) {
          $output->writeln('Pronostic : '.
            $pronostic['username'] . ' ' .
            $pronostic['nbCafe']
          );
        }
        $output->writeln('Fin des pronostics.');
    }

}
