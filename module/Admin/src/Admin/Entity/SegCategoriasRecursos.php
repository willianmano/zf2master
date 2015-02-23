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
    protected $ctrId;

    /**
     * @var string
     *
     * @ORM\Column(name="ctr_nome", type="string", length=45, nullable=false)
     */
    protected $ctrNome;

    /**
     * @var string
     *
     * @ORM\Column(name="ctr_descricao", type="string", length=300, nullable=true)
     */
    protected $ctrDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ctr_icone", type="string", length=45, nullable=false)
     */
    protected $ctrIcone = 'icon-bookmark';

    /**
     * @var integer
     *
     * @ORM\Column(name="ctr_ordem", type="integer", nullable=false)
     */
    protected $ctrOrdem = 10;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ctr_visivel", type="boolean", nullable=false)
     */
    protected $ctrVisivel = '0';

    public function exchangeArray($data)
    {
        $this->ctrId = (isset($data['ctrId'])) ? $data['ctrId'] : null;
        $this->ctrNome = (isset($data['ctrNome'])) ? $data['ctrNome'] : null;
        $this->ctrDescricao = (isset($data['ctrDescricao'])) ? $data['ctrDescricao'] : null;
        $this->ctrIcone = (isset($data['ctrIcone'])) ? $data['ctrIcone'] : 'icon-bookmark';
        $this->ctrOrdem = (isset($data['ctrOrdem'])) ? $data['ctrOrdem'] : 10;
        $this->ctrVisivel = (isset($data['ctrVisivel'])) ? $data['ctrVisivel'] : '0';
    }

}
