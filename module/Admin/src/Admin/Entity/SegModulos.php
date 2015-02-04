<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;
use Core\Entity\EntityInterface;

/**
 * SegModulos
 *
 * @ORM\Table(name="seg_modulos")
 * @ORM\Entity
 */
class SegModulos extends BaseEntity implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="mod_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $modId;

    /**
     * @var string
     *
     * @ORM\Column(name="mod_nome", type="string", length=150, nullable=false)
     */
    private $modNome;

    /**
     * @var string
     *
     * @ORM\Column(name="mod_descricao", type="string", length=300, nullable=true)
     */
    private $modDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="mod_icone", type="string", length=45, nullable=true)
     */
    private $modIcone = 'icon-cog';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mod_ativo", type="boolean", nullable=false)
     */
    private $modAtivo = '0';

    public function exchangeArray($data)
    {
        $this->modNome = (isset($data['modNome'])) ? $data['modNome'] : null;
        $this->modDescricao = (isset($data['modDescricao'])) ? $data['modDescricao'] : null;
        $this->modIcone = (isset($data['modIcone'])) ? $data['modIcone'] : 'icon-cog';
        $this->modAtivo = (isset($data['modAtivo'])) ? $data['modAtivo'] : '0';
    }
}
