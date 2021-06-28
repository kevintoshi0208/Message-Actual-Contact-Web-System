<?php

namespace App\Entity;

use App\Repository\BussinessRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Groups({"show_business"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Groups({"show_business"})
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @Assert\NotBlank()
     * @Groups({"show_business"})
     * @ORM\Column(type="decimal", precision=8, scale=3)
     */
    private $wgs84N;

    /**
     * @Assert\NotBlank()
     * @Groups({"show_business"})
     * @ORM\Column(type="decimal", precision=8, scale=5)
     */
    private $wgs84E;

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

    public function getWgs84N(): ?string
    {
        return $this->wgs84N;
    }

    public function setWgs84N(string $wgs84N): self
    {
        $this->wgs84N = $wgs84N;

        return $this;
    }

    public function getWgs84E(): ?string
    {
        return $this->wgs84E;
    }

    public function setWgs84E(string $wgs84E): self
    {
        $this->wgs84E = $wgs84E;

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
