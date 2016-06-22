<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="fos_user")
  * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

  /**
   * @var int
   *
     * @ORM\Column(name="nbCafe", type="integer")
   */
  private $nbCafe;
  /**
   * @var int
   *
     * @ORM\Column(name="$nbPariGagne", type="integer")
   */
  private $nbPariGagne;
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
