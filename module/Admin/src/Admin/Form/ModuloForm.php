<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class ModuloForm extends Form
{
    public function __construct()
    {
        parent::__construct('novoModulo');

        $this->setAttribute('method', 'post');
        $this->setAttribute('class','form-horizontal');
        $this->setAttribute('role','form');
        $this->setAttribute('action', '/admin/modulos/create');

        $modId = new Element\Hidden('modId');

        $modNome = new Element\Text('modNome');
        $modNome->setName('modNome')
            ->setAttribute('id', 'modNome')
            ->setAttribute('placeholder', 'Nome do módulo')
            ->setAttribute('class', 'form-control')
            ->setLabel('Nome do módulo')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $modDescricao = new Element\Text('modDescricao');
        $modDescricao->setName('modDescricao')
            ->setAttribute('id', 'modDescricao')
            ->setAttribute('placeholder', 'Descrição do módulo')
            ->setAttribute('class', 'form-control')
            ->setLabel('Descrição do módulo')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $modIcone = new Element\Text('modIcone');
        $modIcone->setName('modIcone')
            ->setAttribute('id', 'modIcone')
            ->setAttribute('placeholder', 'Ícone do módulo')
            ->setAttribute('class', 'form-control')
            ->setLabel('Ícone do módulo')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $submit = new Element\Submit('submit');
        $submit->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-info');

        $this->add($modId)
            ->add($modNome)
            ->add($modDescricao)
            ->add($modIcone)
            ->add($submit);
    }
}