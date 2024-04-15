<?php

namespace App\Entity;

use App\Repository\ListFieldsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ListFieldsRepository::class)]
class ListFields
{
    #[ORM\ManyToOne(targetEntity: MyList::class, inversedBy: 'products')]
    private MyList $myList;

    public function getCategory(): ?MyList
    {
        return $this->myList;
    }

    public function setCategory(?MyList $myList): self
    {
        $this->myList = $myList;

        return $this;
    }



    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $ListID = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isChecked = null;

    #[ORM\Column(nullable: true)]
    private ?float $cost = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $CreatorUserID = null;

    #[ORM\Column(type: 'uuid', nullable: true)]
    private ?Uuid $CheckedUserID = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getListID(): ?Uuid
    {
        return $this->ListID;
    }

    public function setListID(Uuid $ListID): static
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
        return $this->isChecked;
    }

    public function setChecked(bool $isChecked): static
    {
        $this->isChecked = $isChecked;

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

    public function getCreatorUserID(): ?Uuid
    {
        return $this->CreatorUserID;
    }

    public function setCreatorUserID(Uuid $CreatorUserID): static
    {
        $this->CreatorUserID = $CreatorUserID;

        return $this;
    }

    public function getCheckedUserID(): ?Uuid
    {
        return $this->CheckedUserID;
    }

    public function setCheckedUserID(?Uuid $CheckedUserID): static
    {
        $this->CheckedUserID = $CheckedUserID;

        return $this;
    }
}
