<?php

namespace App\Entity;

use App\Repository\MyListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: MyListRepository::class)]
#[ApiResource]
class MyList
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'myList')]
    private Collection $UserID;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $CreateDate = null;

    #[ORM\ManyToOne(inversedBy: 'ownedList')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $OwnerUserID = null;

    /**
     * @var Collection<int, ListField>
     */
    #[ORM\OneToMany(targetEntity: ListField::class, mappedBy: 'ListID', orphanRemoval: true)]
    private Collection $listFields;

    public function __construct()
    {
        $this->UserID = new ArrayCollection();
        $this->listFields = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserID(): Collection
    {
        return $this->UserID;
    }

    public function addUserID(User $userID): static
    {
        if (!$this->UserID->contains($userID)) {
            $this->UserID->add($userID);
        }

        return $this;
    }

    public function removeUserID(User $userID): static
    {
        $this->UserID->removeElement($userID);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

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

    public function getOwnerUserID(): ?User
    {
        return $this->OwnerUserID;
    }

    public function setOwnerUserID(?User $OwnerUserID): static
    {
        $this->OwnerUserID = $OwnerUserID;

        return $this;
    }

    /**
     * @return Collection<int, ListField>
     */
    public function getListFields(): Collection
    {
        return $this->listFields;
    }

    public function addListField(ListField $listField): static
    {
        if (!$this->listFields->contains($listField)) {
            $this->listFields->add($listField);
            $listField->setListID($this);
        }

        return $this;
    }

    public function removeListField(ListField $listField): static
    {
        if ($this->listFields->removeElement($listField)) {
            // set the owning side to null (unless already changed)
            if ($listField->getListID() === $this) {
                $listField->setListID(null);
            }
        }

        return $this;
    }
}
