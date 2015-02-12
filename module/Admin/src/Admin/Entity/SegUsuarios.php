<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;
use Core\Entity\EntityInterface;

/**
 * SegUsuarios
 *
 * @ORM\Table(name="seg_usuarios")
 * @ORM\Entity
 */
class SegUsuarios extends BaseEntity implements EntityInterface
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

    public static function getIdentifier()
    {
        return 'usrId';
    }

    /**
     * Populate the object from an array.
     *
     * @param $data
     */
    public function exchangeArray($data)
    {
        $this->usrId = (isset($data['usrId'])) ? $data['usrId'] : null;
        $this->usrNome = (isset($data['usrNome'])) ? $data['usrNome'] : null;
        $this->usrEmail = (isset($data['usrEmail'])) ? $data['usrEmail'] : null;
        $this->usrTelefone = (isset($data['usrTelefone'])) ? $data['usrTelefone'] : null;
        $this->usrUsuario = (isset($data['usrUsuario'])) ? $data['usrUsuario'] : null;
        $this->usrSenha = (isset($data['usrSenha'])) ? $data['usrSenha'] : null;
        $this->usrAtivo = (isset($data['usrAtivo'])) ? $data['usrAtivo'] : '1';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pruPrf = new \Doctrine\Common\Collections\ArrayCollection();
    }
}