<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
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
     * @var int
     *
     * @ORM\Column(name="nbCafesGagnes", nullable=true, type="integer")
     */
    private $nbCafesGagnes;

    /**
     * @var int
     *
     * @ORM\Column(name="nbParisGagnes", nullable=true, type="integer")
     */
    private $nbParisGagnes;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set nbCafesGagnes
     *
     * @param integer $nbCafesGagnes
     * @return User
     */
    public function setNbCafesGagnes($nbCafesGagnes)
    {
        $this->nbCafesGagnes = $nbCafesGagnes;

        return $this;
    }

    /**
     * Get nbCafesGagnes
     *
     * @return integer
     */
    public function getNbCafesGagnes()
    {
        return $this->nbCafesGagnes;
    }

    /**
     * Set nbParisGagnes
     *
     * @param integer $nbParisGagnes
     * @return User
     */
    public function setNbParisGagnes($nbParisGagnes)
    {
        $this->nbParisGagnes = $nbParisGagnes;

        return $this;
    }

    /**
     * Get nbParisGagnes
     *
     * @return integer
     */
    public function getNbParisGagnes()
    {
        return $this->nbParisGagnes;
    }
}
