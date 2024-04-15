<?php

namespace App\Entity;

use App\Repository\MyListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: MyListRepository::class)]
class MyList
{
    #[ORM\OneToMany(targetEntity: ListFields::class, mappedBy: 'ListID')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Collection<int, ListFields>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }



    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $CreateDate = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $OwnerUserID = null;

    public function getId(): ?Uuid
    {
        return $this->id;
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

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->CreateDate;
    }

    public function setCreateDate(\DateTimeInterface $CreateDate): static
    {
        $this->CreateDate = $CreateDate;

        return $this;
    }

    public function getOwnerUserID(): ?Uuid
    {
        return $this->OwnerUserID;
    }

    public function setOwnerUserID(Uuid $OwnerUserID): static
    {
        $this->OwnerUserID = $OwnerUserID;

        return $this;
    }
}
