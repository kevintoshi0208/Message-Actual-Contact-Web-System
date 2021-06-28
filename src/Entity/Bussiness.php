<?php

namespace App\Entity;

use App\Repository\BussinessRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BussinessRepository::class)
 */
class Bussiness
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3)
     */
    private $WGS84N;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=5)
     */
    private $WGS84E;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_time", type="datetime", nullable=true, options={"comment"="建立資料時間"})
     */
    private $createdTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_time", type="datetime", nullable=true, options={"comment"="異動資料時間"})
     */
    private $updatedTime;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getWGS84N(): ?string
    {
        return $this->WGS84N;
    }

    public function setWGS84N(string $WGS84N): self
    {
        $this->WGS84N = $WGS84N;

        return $this;
    }

    public function getWGS84E(): ?string
    {
        return $this->WGS84E;
    }

    public function setWGS84E(string $WGS84E): self
    {
        $this->WGS84E = $WGS84E;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * @param \DateTime|null $createdTime
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }

    /**
     * @param \DateTime|null $updatedTime
     */
    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;
    }
}
