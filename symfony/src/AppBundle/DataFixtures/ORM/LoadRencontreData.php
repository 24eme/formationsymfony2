<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rencontre;

class LoadRencontreData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $rencontres = $this->container->get('kernel')->getRootDir().'/Resources/data/rencontres.csv';

        foreach(file($rencontres) as $line) {
            if(preg_match("/^#/", $line)) {
                continue;
            }
            $data = str_getcsv($line, ";");
            $rencontre = new Rencontre();
            $rencontre->setDate(new \DateTime($data[0]));
            $rencontre->setLibelle($data[1]);
            $rencontre->setEquipeA($data[2]);
            $rencontre->setEquipeB($data[3]);
            $rencontre->setScoreA($data[4]);
            $rencontre->setScoreB($data[5]);
            $manager->persist($rencontre);
        }


        $manager->flush();
    }
}
