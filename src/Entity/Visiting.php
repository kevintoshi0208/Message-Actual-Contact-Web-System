<?php

namespace App\Entity;

use App\Repository\BusinessRepository;
use App\Repository\VisitingRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: VisitingRepository::class)]
class Visiting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "bigint")]
    private $id;

    #[Length(max: 20)]
    #[NotBlank()]
    #[Groups("show_visiting")]
    #[ORM\Column(type:"string", length:20)]
    private ?string $phone;

    #[ORM\Column(
        name:"visit_time",
        type:"datetime",
        nullable:false,
        options:["comment"=>"到訪時間"]
    )]
    #[NotBlank()]
    #[Groups("show_visiting")]
    private ?\DateTime $visitTime = null;

    #[ORM\Column(
        name:"created_time",
        type:"datetime",
        nullable:true,
        options:["comment"=>"建立資料時間"]
    )]
    private ?\DateTime $createdTime = null;

    #[ORM\Column(
        name:"updated_time",
        type:"datetime",
        nullable:true,
        options:["comment"=>"異動資料時間"]
    )]
    private ?\DateTime $updatedTime =null;

    #[ORM\ManyToOne(targetEntity:"Business")]
    private ?Business $business =null;

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

    /**
     * @return \DateTime|null
     */
    public function getVisitTime(): ?\DateTime
    {
        return $this->visitTime;
    }

    /**
     * @param \DateTime|null $visitTime
     */
    public function setVisitTime(?\DateTime $visitTime): void
    {
        $this->visitTime = $visitTime;
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

    #[Pure] #[Groups("show_visiting")]
    public function getCode(): string
    {
        return $this->business? $this->business->getCode():"";
    }
}
