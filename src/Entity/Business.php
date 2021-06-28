<?php

namespace App\Entity;

use App\Repository\BusinessRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BusinessRepository::class)]
class Business
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "bigint")]
    private ?int $id;

    #[Assert\NotBlank]
    #[Groups("show_business")]
    #[ORM\Column(type:"string", length:255)]
    private ?string $name;

    #[Assert\NotBlank]
    #[Groups("show_business")]
    #[ORM\Column(type:"string", length:255)]
    private mixed $address;

    #[Assert\NotBlank]
    #[Groups("show_business")]
    #[ORM\Column(type:"decimal", precision:8, scale:3)]
    private ?string $wgs84N;


    #[Assert\NotBlank]
    #[Groups("show_business")]
    #[ORM\Column(type:"decimal", precision:8, scale:3)]
    private ?string $wgs84E;

    #[ORM\Column(
        name:"created_time",
        type:"datetime",
        nullable:true,
        options:["comment"=>"建立資料時間"]
    )]
    private ?\DateTime $createdTime;

    #[ORM\Column(
        name:"updated_time",
        type:"datetime",
        nullable:true,
        options:["comment"=>"異動資料時間"]
    )]
    private ?\DateTime $updatedTime;


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

    public function getAddress(): mixed
    {
        return $this->address;
    }

    public function setAddress(mixed $address)
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

    public function getCreatedTime(): ?\DateTime
    {
        return $this->createdTime;
    }

    public function setCreatedTime(?\DateTime $createdTime)
    {
        $this->createdTime = $createdTime;
    }

    public function getUpdatedTime(): ?\DateTime
    {
        return $this->updatedTime;
    }

    public function setUpdatedTime(?\DateTime $updatedTime)
    {
        $this->updatedTime = $updatedTime;
    }
}
