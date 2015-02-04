<?php

namespace Admin\Entity;

use Core\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;

/**
 * SegCategoriasRecursos
 *
 * @ORM\Table(name="seg_categorias_recursos")
 * @ORM\Entity
 */
class SegCategoriasRecursos extends BaseEntity implements EntityInterface
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

    public static function getIdentifier()
    {
        return 'ctrId';
    }

    public function exchangeArray($data)
    {
        $this->ctrNome = (isset($data['ctrNome'])) ? $data['ctrNome'] : null;
        $this->ctrDescricao = (isset($data['ctrDescricao'])) ? $data['ctrDescricao'] : null;
        $this->ctrIcone = (isset($data['ctrIcone'])) ? $data['ctrIcone'] : 'icon-bookmark';
    }

}
