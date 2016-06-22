<?php
namespace AppBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class WhoIsTheBestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('whoIsTheBest')->setDescription('...')->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')->addOption('option', null, InputOption::VALUE_NONE, 'Option description');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');
        //////////////////////
        $userRepo = $this->getContainer()->get('doctrine')->getRepository("AppBundle:User");
        $users    = $userRepo->findAll();
        foreach ($users as $user) {
            $pronoRepo   = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Pronostic");
            $parisDuUser = $pronoRepo->findBy(array(
                "utilisateur" => $user->getId()
            ));
            $user->setNbParisGagnes(0);
            $user->setNbCafesGagnes(0);
            $cpt = $user->getNbParisGagnes();
            $cptCafes = $user->getNbCafesGagnes();
            foreach ($parisDuUser as $pariDuUser) {
                if ($pariDuUser->isGagne()) {
                    $cpt++;
                    $cptCafes = $cptCafes + $pariDuUser->getNbCafes();
                    //$output->writeln($cpt);
                }
            }
            $user->setNbParisGagnes($cpt);
            $user->setNbCafesGagnes($cptCafes);
        }
        $this->getContainer()->get('doctrine')->getManager()->flush();
        /////////////////////
    }
}
