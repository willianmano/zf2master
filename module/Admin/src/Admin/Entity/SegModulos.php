<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\BaseEntity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
/**
 * SegModulos
 *
 * @ORM\Table(name="seg_modulos")
 * @ORM\Entity
 */
class SegModulos extends BaseEntity implements InputFilterAwareInterface
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
        $this->modId = (isset($data['modId'])) ? $data['modId'] : null;
        $this->modNome = (isset($data['modNome'])) ? $data['modNome'] : null;
        $this->modDescricao = (isset($data['modDescricao'])) ? $data['modDescricao'] : null;
        $this->modIcone = (isset($data['modIcone'])) ? $data['modIcone'] : 'icon-cog';
        $this->modAtivo = (isset($data['modAtivo'])) ? $data['modAtivo'] : '0';
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'modNome',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 150,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'modDescricao',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 150,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'modIcone',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 45,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
