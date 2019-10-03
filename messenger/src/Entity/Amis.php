<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amis
 *
 * @ORM\Table(name="amis", indexes={@ORM\Index(name="Amis_user0_FK", columns={"id_user_amis"}), @ORM\Index(name="Amis_user_FK", columns={"id_user"})})
 * @ORM\Entity
 */
class Amis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_amis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAmis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="text", length=50, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="message", type="text", length=250, nullable=true)
     */
    private $message;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_amis", referencedColumnName="id_user")
     * })
     */
    private $idUserAmis;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdAmis(): ?int
    {
        return $this->idAmis;
    }

    public function getIdMessage(): ?int
    {
        return $this->idMessage;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getIdUsername(): ?int
    {
        return $this->idusername;
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

    public function getIdUserAmis(): ?User
    {
        return $this->idUserAmis;
    }

    public function setIdUserAmis(?User $idUserAmis): self
    {
        $this->idUserAmis = $idUserAmis;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }



}
