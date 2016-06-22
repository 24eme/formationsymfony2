<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pronostic
 *
 * @ORM\Table(name="pronostic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PronosticRepository")
 */
class Pronostic
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
    */
    private $utilisateur;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreA", type="integer")
     */
    private $scoreA;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreB", type="integer")
     */
    private $scoreB;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_cafe", nullable=true, type="integer")
     */
    private $nbCafe;

    /**
     * @var Rencontre
     *
     * @ORM\ManyToOne(targetEntity="Rencontre", inversedBy="pronostics")
    */
    private $rencontre;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set scoreA
     *
     * @param integer $scoreA
     * @return Pronostic
     */
    public function setScoreA($scoreA)
    {
        $this->scoreA = $scoreA;

        return $this;
    }

    /**
     * Get scoreA
     *
     * @return integer
     */
    public function getScoreA()
    {
        return $this->scoreA;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Pronostic
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set scoreB
     *
     * @param integer $scoreB
     * @return Pronostic
     */
    public function setScoreB($scoreB)
    {
        $this->scoreB = $scoreB;

        return $this;
    }

    /**
     * Get scoreB
     *
     * @return integer
     */
    public function getScoreB()
    {
        return $this->scoreB;
    }

    /**
     * Set nbCafe
     *
     * @param integer $nbCafe
     * @return Pronostic
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
     * Set rencontre
     *
     * @param \AppBundle\Entity\Rencontre $rencontre
     * @return Pronostic
     */
    public function setRencontre(\AppBundle\Entity\Rencontre $rencontre = null)
    {
        $this->rencontre = $rencontre;

        return $this;
    }

    /**
     * Get rencontre
     *
     * @return \AppBundle\Entity\Rencontre
     */
    public function getRencontre()
    {
        return $this->rencontre;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\User $utilisateur
     *
     * @return Pronostic
     */
    public function setUtilisateur(\AppBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\User
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
