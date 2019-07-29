<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conv
 *
 * @ORM\Table(name="conv")
 * @ORM\Entity
 */
class Conv
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_conv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConv;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=0, nullable=false)
     */
    private $message;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idConv")
     * @ORM\JoinTable(name="relation3",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_conv", referencedColumnName="id_conv")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     *   }
     * )
     */
    private $idUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUser = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
