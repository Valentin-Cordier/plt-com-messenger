<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message="L'email que vous avez indiqué est déjà utilisé !"
 * )
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=250, nullable=false)
     * @Assert\Length(min="4", minMessage="Votre mot de passe doit faire 4 caractères")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas entré le même mot de passe")
     */
    public $confirm_password;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Groupe", mappedBy="idUser")
     */
    private $idGroupe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="idUser")
     * @ORM\JoinTable(name="userroles",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_role", referencedColumnName="id_role")
     *   }
     * )
     */
    private $idRole;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idGroupe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idRole = new \Doctrine\Common\Collections\ArrayCollection();
        }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function __toString()
    {
        return $this->username;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {}

    public function getRoles() {
        if (empty($this->roles)) {
            return ['ROLE_USER'];
        }
        return $this->roles;
    }

    function addRole($role) {
        $this->roles[] = $role;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getIdGroupe(): Collection
    {
        return $this->idGroupe;
    }

    public function addIdGroupe(Groupe $idGroupe): self
    {
        if (!$this->idGroupe->contains($idGroupe)) {
            $this->idGroupe[] = $idGroupe;
            $idGroupe->addIdUser($this);
        }

        return $this;
    }

    public function removeIdGroupe(Groupe $idGroupe): self
    {
        if ($this->idGroupe->contains($idGroupe)) {
            $this->idGroupe->removeElement($idGroupe);
            $idGroupe->removeIdUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getIdRole(): Collection
    {
        return $this->idRole;
    }

    public function addIdRole(Role $idRole): self
    {
        if (!$this->idRole->contains($idRole)) {
            $this->idRole[] = $idRole;
            $idRole->addIdUser($this);
        }

        return $this;
    }

    public function removeIdRole(Role $idRole): self
    {
        if ($this->idRole->contains($idRole)) {
            $this->idRole->removeElement($idRole);
            $idRole->removeIdUser($this);
        }

        return $this;
    }

}