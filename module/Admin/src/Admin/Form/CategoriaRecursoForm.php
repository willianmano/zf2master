<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class CategoriaRecursoForm extends Form
{
    public function __construct()
    {
        parent::__construct('novaCategoriaRecurso');

        $this->setAttribute('method', 'post');
        $this->setAttribute('class','form-horizontal');
        $this->setAttribute('role','form');
        $this->setAttribute('action', '/admin/categoriasrecursos/create');

        $ctrId = new Element\Hidden('ctrId');

        $ctrNome = new Element\Text('ctrNome');
        $ctrNome->setName('ctrNome')
            ->setAttribute('placeholder', 'Nome')
            ->setAttribute('class', 'form-control')
            ->setLabel('Nome')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $ctrDescricao = new Element\Text('ctrDescricao');
        $ctrDescricao->setName('ctrDescricao')
            ->setAttribute('placeholder', 'Descrição')
            ->setAttribute('class', 'form-control')
            ->setLabel('Descrição')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $ctrIcone = new Element\Text('ctrIcone');
        $ctrIcone->setName('ctrIcone')
            ->setAttribute('placeholder', 'Ícone')
            ->setAttribute('class', 'form-control')
            ->setLabel('Ícone')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $submit = new Element\Submit('submit');
        $submit->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-info');

        $this->add($ctrId)
            ->add($ctrNome)
            ->add($ctrDescricao)
            ->add($ctrIcone)
            ->add($submit);
    }
}
