<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, MyLists>
     */
    #[ORM\ManyToMany(targetEntity: MyLists::class, mappedBy: 'UserID')]
    private Collection $myLists;

    /**
     * @var Collection<int, MyLists>
     */
    #[ORM\OneToMany(targetEntity: MyLists::class, mappedBy: 'OwnerUserID')]
    private Collection $ownedLists;

    /**
     * @var Collection<int, ListFields>
     */
    #[ORM\OneToMany(targetEntity: ListFields::class, mappedBy: 'CheckUser')]
    private Collection $listFieldsChecked;

    public function __construct()
    {
        $this->myLists = new ArrayCollection();
        $this->ownedLists = new ArrayCollection();
        $this->listFieldsChecked = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, MyLists>
     */
    public function getMyLists(): Collection
    {
        return $this->myLists;
    }

    public function addMyList(MyLists $myList): static
    {
        if (!$this->myLists->contains($myList)) {
            $this->myLists->add($myList);
            $myList->addUserID($this);
        }

        return $this;
    }

    public function removeMyList(MyLists $myList): static
    {
        if ($this->myLists->removeElement($myList)) {
            $myList->removeUserID($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MyLists>
     */
    public function getOwnedLists(): Collection
    {
        return $this->ownedLists;
    }

    public function addOwnedList(MyLists $ownedList): static
    {
        if (!$this->ownedLists->contains($ownedList)) {
            $this->ownedLists->add($ownedList);
            $ownedList->setOwnerUserID($this);
        }

        return $this;
    }

    public function removeOwnedList(MyLists $ownedList): static
    {
        if ($this->ownedLists->removeElement($ownedList)) {
            // set the owning side to null (unless already changed)
            if ($ownedList->getOwnerUserID() === $this) {
                $ownedList->setOwnerUserID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ListFields>
     */
    public function getListFieldsChecked(): Collection
    {
        return $this->listFieldsChecked;
    }

    public function addListFieldsChecked(ListFields $listFieldsChecked): static
    {
        if (!$this->listFieldsChecked->contains($listFieldsChecked)) {
            $this->listFieldsChecked->add($listFieldsChecked);
            $listFieldsChecked->setCheckUser($this);
        }

        return $this;
    }

    public function removeListFieldsChecked(ListFields $listFieldsChecked): static
    {
        if ($this->listFieldsChecked->removeElement($listFieldsChecked)) {
            // set the owning side to null (unless already changed)
            if ($listFieldsChecked->getCheckUser() === $this) {
                $listFieldsChecked->setCheckUser(null);
            }
        }

        return $this;
    }
}
