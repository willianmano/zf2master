<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;
use Core\Entity\EntityInterface;

/**
 * SegPermissoes
 *
 * @ORM\Table(name="seg_permissoes", indexes={@ORM\Index(name="fk_seg_permissoes_seg_recursos1", columns={"prm_rcs_id"})})
 * @ORM\Entity
 */
class SegPermissoes extends BaseEntity implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="prm_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $prmId;

    /**
     * @var string
     *
     * @ORM\Column(name="prm_nome", type="string", length=45, nullable=false)
     */
    protected $prmNome;

    /**
     * @var string
     *
     * @ORM\Column(name="prm_descricao", type="string", length=300, nullable=true)
     */
    protected $prmDescricao;

    /**
     * @var \Admin\Entity\SegRecursos
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\SegRecursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prm_rcs_id", referencedColumnName="rcs_id")
     * })
     */
    protected $prmRcs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Admin\Entity\SegPerfis", mappedBy="prpPrm")
     */
    protected $prpPrf;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prpPrf = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function exchangeArray($data)
    {
        $this->prmId = (isset($data['prmId'])) ? $data['prmId'] : null;
        $this->prmNome = (isset($data['prmNome'])) ? $data['prmNome'] : null;
        $this->prmDescricao = (isset($data['prmDescricao'])) ? $data['prmDescricao'] : null;
    }

}
