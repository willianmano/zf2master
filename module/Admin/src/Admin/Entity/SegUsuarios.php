<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;

/**
 * SegUsuarios
 *
 * @ORM\Table(name="seg_usuarios")
 * @ORM\Entity
 */
class SegUsuarios extends BaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usrId;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_nome", type="string", length=150, nullable=false)
     */
    private $usrNome;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_email", type="string", length=150, nullable=false)
     */
    private $usrEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_telefone", type="string", length=15, nullable=true)
     */
    private $usrTelefone;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_usuario", type="string", length=45, nullable=false)
     */
    private $usrUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_senha", type="string", length=100, nullable=false)
     */
    private $usrSenha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usr_ativo", type="boolean", nullable=false)
     */
    private $usrAtivo = '1';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Admin\Entity\SegPerfis", mappedBy="pruUsr")
     */
    private $pruPrf;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pruPrf = new \Doctrine\Common\Collections\ArrayCollection();
    }
}