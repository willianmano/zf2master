<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;

/**
 * SegCategoriasRecursos
 *
 * @ORM\Table(name="seg_categorias_recursos")
 * @ORM\Entity
 */
class SegCategoriasRecursos extends BaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ctr_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ctrId;

    /**
     * @var string
     *
     * @ORM\Column(name="ctr_nome", type="string", length=45, nullable=false)
     */
    private $ctrNome;

    /**
     * @var string
     *
     * @ORM\Column(name="ctr_descricao", type="string", length=300, nullable=true)
     */
    private $ctrDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ctr_icone", type="string", length=45, nullable=false)
     */
    private $ctrIcone = 'icon-bookmark';


}
