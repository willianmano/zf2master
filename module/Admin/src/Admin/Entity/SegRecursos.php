<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;

/**
 * SegRecursos
 *
 * @ORM\Table(name="seg_recursos", indexes={@ORM\Index(name="fk_seg_recursos_seg_modulos1", columns={"rcs_mod_id"}), @ORM\Index(name="fk_seg_recursos_seg_categorias_recursos1", columns={"rcs_ctr_id"})})
 * @ORM\Entity
 */
class SegRecursos extends BaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="rcs_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rcsId;

    /**
     * @var string
     *
     * @ORM\Column(name="rcs_nome", type="string", length=150, nullable=false)
     */
    private $rcsNome;

    /**
     * @var string
     *
     * @ORM\Column(name="rcs_descricao", type="string", length=300, nullable=true)
     */
    private $rcsDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="rcs_icone", type="string", length=45, nullable=true)
     */
    private $rcsIcone = 'icon-code';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rcs_ativo", type="boolean", nullable=false)
     */
    private $rcsAtivo = '0';

    /**
     * @var \Admin\Entity\SegModulos
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\SegModulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rcs_mod_id", referencedColumnName="mod_id")
     * })
     */
    private $rcsMod;

    /**
     * @var \Admin\Entity\SegCategoriasRecursos
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\SegCategoriasRecursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rcs_ctr_id", referencedColumnName="ctr_id")
     * })
     */
    private $rcsCtr;


}
