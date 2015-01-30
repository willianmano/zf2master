<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;

/**
 * SegPerfis
 *
 * @ORM\Table(name="seg_perfis", indexes={@ORM\Index(name="fk_seg_perfis_seg_modulos1", columns={"prf_mod_id"})})
 * @ORM\Entity
 */
class SegPerfis extends BaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="prf_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $prfId;

    /**
     * @var string
     *
     * @ORM\Column(name="prf_nome", type="string", length=150, nullable=false)
     */
    private $prfNome;

    /**
     * @var string
     *
     * @ORM\Column(name="prf_descricao", type="string", length=300, nullable=true)
     */
    private $prfDescricao;

    /**
     * @var \Admin\Entity\SegModulos
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\SegModulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prf_mod_id", referencedColumnName="mod_id")
     * })
     */
    private $prfMod;

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
    private $prpPrm;

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
    private $pruUsr;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prpPrm = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pruUsr = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
