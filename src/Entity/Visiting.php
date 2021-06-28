<?php

namespace App\Entity;

use App\Repository\BusinessRepository;
use App\Repository\VisitingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisitingRepository::class)]
class Visiting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "bigint")]
    private $id;

    #[ORM\ManyToOne(targetEntity:"Business")]
    private ?Business $business;

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

    #[ORM\Column(type:"string", length:20)]
    private ?string $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBusiness(): mixed
    {
        return $this->business;
    }

    public function setBusiness(mixed $business)
    {
        $this->business = $business;
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
