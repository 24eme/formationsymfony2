<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
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

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
    * @var int
    * @ORM\Column(name="nbCafe", type="integer")
    */
    private $nbCafe;

    /**
    * @var int
    * @ORM\Column(name="nbPariGagne", type="integer")
    */
    private $nbPariGagne;


    /**
     * Set nbCafe
     *
     * @param integer $nbCafe
     *
     * @return User
     */
    public function setNbCafe($nbCafe)
    {
        $this->nbCafe = $nbCafe;

        return $this;
    }

    /**
     * Get nbCafe
     *
     * @return integer
     */
    public function getNbCafe()
    {
        return $this->nbCafe;
    }

    /**
     * Set nbPariGagne
     *
     * @param integer $nbPariGagne
     *
     * @return User
     */
    public function setNbPariGagne($nbPariGagne)
    {
        $this->nbPariGagne = $nbPariGagne;

        return $this;
    }

    /**
     * Get nbPariGagne
     *
     * @return integer
     */
    public function getNbPariGagne()
    {
        return $this->nbPariGagne;
    }
}
