<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\OneToMany(targetEntity="Pronostic", mappedBy="utilisateur")
     */
    private $pronostics;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add pronostic
     *
     * @param \AppBundle\Entity\Pronostic $pronostic
     *
     * @return User
     */
    public function addPronostic(\AppBundle\Entity\Pronostic $pronostic)
    {
        $this->pronostics[] = $pronostic;

        return $this;
    }

    /**
     * Remove pronostic
     *
     * @param \AppBundle\Entity\Pronostic $pronostic
     */
    public function removePronostic(\AppBundle\Entity\Pronostic $pronostic)
    {
        $this->pronostics->removeElement($pronostic);
    }

    /**
     * Get pronostics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPronostics()
    {
        return $this->pronostics;
    }
}
