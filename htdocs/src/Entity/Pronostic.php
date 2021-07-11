<?php

namespace App\Entity;

use App\Repository\PronosticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PronosticRepository::class)
 */
class Pronostic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userid;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchid;

    /**
     * @ORM\Column(type="integer")
     */
    private $domicileBet;

    /**
     * @ORM\Column(type="integer")
     */
    private $exterieurBet;

    /**
     * @ORM\Column(type="integer")
     */
    private $scoreBet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getMatchid(): ?int
    {
        return $this->matchid;
    }

    public function setMatchid(int $matchid): self
    {
        $this->matchid = $matchid;

        return $this;
    }

    public function getDomicileBet(): ?int
    {
        return $this->domicileBet;
    }

    public function setDomicileBet(int $domicileBet): self
    {
        $this->domicileBet = $domicileBet;

        return $this;
    }

    public function getExterieurBet(): ?int
    {
        return $this->exterieurBet;
    }

    public function setExterieurBet(int $exterieurBet): self
    {
        $this->exterieurBet = $exterieurBet;

        return $this;
    }

    public function getScoreBet(): ?int
    {
        return $this->scoreBet;
    }

    public function setScoreBet(int $scoreBet): self
    {
        $this->scoreBet = $scoreBet;

        return $this;
    }
}
