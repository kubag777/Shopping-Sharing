<?php

namespace App\Entity;

use App\Repository\ListFieldsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ListFieldsRepository::class)]
#[ApiResource]
class ListField
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(inversedBy: 'listFields')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MyList $ListID = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $IsChecked = null;

    #[ORM\Column(nullable: true)]
    private ?float $cost = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $CreateUser = null;

    #[ORM\ManyToOne(inversedBy: 'listFieldsChecked')]
    private ?User $CheckUser = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getListID(): ?MyList
    {
        return $this->ListID;
    }

    public function setListID(?MyList $ListID): static
    {
        $this->ListID = $ListID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isChecked(): ?bool
    {
        return $this->IsChecked;
    }

    public function setChecked(bool $IsChecked): static
    {
        $this->IsChecked = $IsChecked;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCreateUser(): ?User
    {
        return $this->CreateUser;
    }

    public function setCreateUser(?User $CreateUser): static
    {
        $this->CreateUser = $CreateUser;

        return $this;
    }

    public function getCheckUser(): ?User
    {
        return $this->CheckUser;
    }

    public function setCheckUser(?User $CheckUser): static
    {
        $this->CheckUser = $CheckUser;

        return $this;
    }
}
