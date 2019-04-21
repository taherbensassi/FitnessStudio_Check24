<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fitness
 *
 * @ORM\Table(name="fitness")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\FitnessRepository")
 */
class Fitness
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Stadt", type="string", length=255)
     */
    private $stadt;

    /**
     * @var int
     *
     * @ORM\Column(name="Preis", type="integer")
     */
    private $preis;

    /**
     * @var bool
     *
     * @ORM\Column(name="offnen_zeit", type="boolean")
     */
    private $offnenZeit;

    /**
     * @var string
     *
     * @ORM\Column(name="trainer", type="string", length=255)
     */
    private $trainer;

    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="BackendBundle\Entity\Bewertung", mappedBy="fitness")
     */
    private $bewertung;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set stadt
     *
     * @param string $stadt
     *
     * @return Fitness
     */
    public function setStadt($stadt)
    {
        $this->stadt = $stadt;

        return $this;
    }

    /**
     * Get stadt
     *
     * @return string
     */
    public function getStadt()
    {
        return $this->stadt;
    }

    /**
     * Set preis
     *
     * @param integer $preis
     *
     * @return Fitness
     */
    public function setPreis($preis)
    {
        $this->preis = $preis;

        return $this;
    }

    /**
     * Get preis
     *
     * @return int
     */
    public function getPreis()
    {
        return $this->preis;
    }

    /**
     * Set offnenZeit
     *
     * @param boolean $offnenZeit
     *
     * @return Fitness
     */
    public function setOffnenZeit($offnenZeit)
    {
        $this->offnenZeit = $offnenZeit;

        return $this;
    }

    /**
     * Get offnenZeit
     *
     * @return bool
     */
    public function getOffnenZeit()
    {
        return $this->offnenZeit;
    }

    /**
     * Set trainer
     *
     * @param string $trainer
     *
     * @return Fitness
     */
    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;

        return $this;
    }

    /**
     * Get trainer
     *
     * @return string
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBewertung()
    {
        return $this->bewertung;
    }

    /**
     * @param mixed $bewertung
     */
    public function setBewertung($bewertung)
    {
        $this->bewertung = $bewertung;
    }



}

