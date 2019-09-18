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


}
