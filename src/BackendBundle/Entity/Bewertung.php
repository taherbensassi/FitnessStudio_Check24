<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Bewertung
 *
 * @ORM\Table(name="bewertung")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\BewertungRepository")
 * @UniqueEntity(fields="fitness", message="Sorry, this fitness  is already in use.")

 */
class Bewertung
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
     * @var int
     *
     * @ORM\Column(name="trainer", type="integer")
     */
    private $trainer;

    /**
     * @var int
     *
     * @ORM\Column(name="duschen", type="integer")
     */
    private $duschen;

    /**
     * @var int
     *
     * @ORM\Column(name="laufzeit", type="integer")
     */
    private $laufzeit;

    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="BackendBundle\Entity\Fitness", inversedBy="bewertung")
     * @ORM\JoinColumn(name="fitness_id", referencedColumnName="id")
     */
    private $fitness;


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
     * Set trainer
     *
     * @param integer $trainer
     *
     * @return Bewertung
     */
    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;

        return $this;
    }

    /**
     * Get trainer
     *
     * @return int
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * Set duschen
     *
     * @param integer $duschen
     *
     * @return Bewertung
     */
    public function setDuschen($duschen)
    {
        $this->duschen = $duschen;

        return $this;
    }

    /**
     * Get duschen
     *
     * @return int
     */
    public function getDuschen()
    {
        return $this->duschen;
    }

    /**
     * Set laufzeit
     *
     * @param integer $laufzeit
     *
     * @return Bewertung
     */
    public function setLaufzeit($laufzeit)
    {
        $this->laufzeit = $laufzeit;

        return $this;
    }

    /**
     * Get laufzeit
     *
     * @return int
     */
    public function getLaufzeit()
    {
        return $this->laufzeit;
    }

    /**
     * @return mixed
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * @param mixed $fitness
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }




}

