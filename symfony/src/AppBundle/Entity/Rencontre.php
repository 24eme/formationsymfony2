<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rencontre
 *
 * @ORM\Table(name="rencontre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RencontreRepository")
 */
class Rencontre
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="equipeA", nullable=true, type="string", length=255)
     */
    private $equipeA;

    /**
     * @var string
     *
     * @ORM\Column(name="equipeB", nullable=true, type="string", length=255)
     */
    private $equipeB;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreA", nullable=true, type="integer")
     */
    private $scoreA;

    /**
     * @var string
     *
     * @ORM\Column(name="scoreB", nullable=true, type="integer")
     */
    private $scoreB;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Rencontre
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
     * Set libelle
     *
     * @param string $libelle
     * @return Rencontre
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set equipeA
     *
     * @param string $equipeA
     * @return Rencontre
     */
    public function setEquipeA($equipeA)
    {
        $this->equipeA = $equipeA;

        return $this;
    }

    /**
     * Get equipeA
     *
     * @return string
     */
    public function getEquipeA()
    {
        return $this->equipeA;
    }

    /**
     * Set equipeB
     *
     * @param string $equipeB
     * @return Rencontre
     */
    public function setEquipeB($equipeB)
    {
        $this->equipeB = $equipeB;

        return $this;
    }

    /**
     * Get equipeB
     *
     * @return string
     */
    public function getEquipeB()
    {
        return $this->equipeB;
    }

    /**
     * Set scoreA
     *
     * @param integer $scoreA
     * @return Rencontre
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
     * Set scoreB
     *
     * @param string $scoreB
     * @return Rencontre
     */
    public function setScoreB($scoreB)
    {
        $this->scoreB = $scoreB;

        return $this;
    }

    /**
     * Get scoreB
     *
     * @return string
     */
    public function getScoreB()
    {
        return $this->scoreB;
    }
}
