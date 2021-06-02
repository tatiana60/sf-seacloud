<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServerRepository::class)
 */
class Server
{
    public const STATE_PENDING = 0;
    public const STATE_STOPPED = 1;
    public const STATE_READY = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $state = self::STATE_PENDING;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpu = 1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ram = 1;

    /**
     * @ORM\ManyToOne(targetEntity=Distribution::class)
     */
    private $distribution;

    /**
     * @ORM\ManyToOne(targetEntity=DataCenter::class)
     */
    private $location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCpu(): ?int
    {
        return $this->cpu;
    }

    public function setCpu(?int $cpu): self
    {
        $this->cpu = $cpu;

        return $this;
    }

    public function getRam(): ?int
    {
        return $this->ram;
    }

    public function setRam(?int $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getDistribution(): ?Distribution
    {
        return $this->distribution;
    }

    public function setDistribution(?Distribution $distribution): self
    {
        $this->distribution = $distribution;

        return $this;
    }

    public function getLocation(): ?DataCenter
    {
        return $this->location;
    }

    public function setLocation(?DataCenter $location): self
    {
        $this->location = $location;

        return $this;
    }
}
