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

        if ($input->getOption('option')) {
            // ...
        }

        $doctrine = $this->getContainer()->get('doctrine');
        $repository = $doctrine->getRepository("AppBundle:User");
        $nbCafe = $repository->getNbCafeGroupByUser();

        $res="";

        foreach ($nbCafe as $user) {
          $objUser=$repository->find(array('id' => $user['id']));

          $objUser->setNbCafe($user['nbCafe']);
          $objUser->setNbPariGagne($user['nbGagne']);

          $res .= $user['username'] . ' <info>a gagné</info> '
            . $objUser->getNbCafe(). ' <fg=yellow>cafés sur </fg=yellow>'
            . $objUser->getNbPariGagne()." <error>pari gagné!</error>\n";
        }

        $doctrine->getManager()->flush();
        $output->writeln($res);
    }


}
