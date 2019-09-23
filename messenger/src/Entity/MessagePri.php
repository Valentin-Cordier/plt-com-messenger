<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessagePri
 *
 * @ORM\Table(name="message_pri", indexes={@ORM\Index(name="message_pri_user0_FK", columns={"id_user_recevoir"}), @ORM\Index(name="message_pri_user_FK", columns={"id_user"})})
 * @ORM\Entity
 */
class MessagePri
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_recevoir", referencedColumnName="id_user")
     * })
     */
    private $idUserRecevoir;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

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

    public function getIdUserRecevoir(): ?User
    {
        return $this->idUserRecevoir;
    }

    public function setIdUserRecevoir(?User $idUserRecevoir): self
    {
        $this->idUserRecevoir = $idUserRecevoir;

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
