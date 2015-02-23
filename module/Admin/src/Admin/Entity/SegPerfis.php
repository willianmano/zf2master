<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;
use Core\Entity\EntityInterface;

/**
 * SegPerfis
 *
 * @ORM\Table(name="seg_perfis", indexes={@ORM\Index(name="fk_seg_perfis_seg_modulos1", columns={"prf_mod_id"})})
 * @ORM\Entity
 */
class SegPerfis extends BaseEntity implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="prf_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $prfId;

    /**
     * @var string
     *
     * @ORM\Column(name="prf_nome", type="string", length=150, nullable=false)
     */
    protected $prfNome;

    /**
     * @var string
     *
     * @ORM\Column(name="prf_descricao", type="string", length=300, nullable=true)
     */
    protected $prfDescricao;

    /**
     * @var \Admin\Entity\SegModulos
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\SegModulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prf_mod_id", referencedColumnName="mod_id")
     * })
     */
    protected $prfMod;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Admin\Entity\SegPermissoes", inversedBy="prpPrf")
     * @ORM\JoinTable(name="seg_perfis_permissoes",
     *   joinColumns={
     *     @ORM\JoinColumn(name="prp_prf_id", referencedColumnName="prf_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="prp_prm_id", referencedColumnName="prm_id")
     *   }
     * )
     */
    protected $prpPrm;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Admin\Entity\SegUsuarios", inversedBy="pruPrf")
     * @ORM\JoinTable(name="seg_perfis_usuarios",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pru_prf_id", referencedColumnName="prf_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pru_usr_id", referencedColumnName="usr_id")
     *   }
     * )
     */
    protected $pruUsr;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prpPrm = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pruUsr = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function exchangeArray($data)
    {
        $this->prfId = (isset($data['prfId'])) ? $data['prfId'] : null;
        $this->prfNome = (isset($data['prfNome'])) ? $data['prfNome'] : null;
        $this->prfDescricao = (isset($data['prfDescricao'])) ? $data['prfDescricao'] : null;
    }

}
