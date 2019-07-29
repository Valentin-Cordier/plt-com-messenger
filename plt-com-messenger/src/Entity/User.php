<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="username", type="string", length=250, nullable=false)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=250, nullable=true, options={"default"="NULL"})
     */
    private $nom = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=250, nullable=true, options={"default"="NULL"})
     */
    private $prenom = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=250, nullable=false)
     */
    private $password;

    public $confirm_password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_de_naissance", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateDeNaissance = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=250, nullable=true, options={"default"="NULL"})
     */
    private $telephone = 'NULL';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Conv", mappedBy="idUser")
     */
    private $idConv;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Groupe", mappedBy="idUser")
     */
    private $idGroupe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idConv = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idGroupe = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
