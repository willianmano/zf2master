<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class PermissaoForm extends Form
{
    public function __construct()
    {
        parent::__construct('novaPermissao');

        $this->setAttribute('method', 'post');
        $this->setAttribute('class','form-horizontal');
        $this->setAttribute('role','form');
        $this->setAttribute('action', '/admin/permissoes/create');

        $prmId = new Element\Hidden('prmId');

        $prmModulo = new Element\Select('prmModulo');
        $prmModulo->setName('prmModulo')
            ->setAttribute('placeholder', 'Módulo do recurso')
            ->setAttribute('id', 'prmModulo')
            ->setLabel('Módulo do recurso')
            ->setLabelAttributes(array('class'=>'control-label'))
            ->setEmptyOption('Escolha um módulo');

        $prmRcs = new Element\Select('prmRcs');
        $prmRcs->setName('prmRcs')
            ->setAttribute('placeholder', 'Recurso da permissão')
            ->setAttribute('id', 'prmRcs')
            ->setLabel('Recurso da Permissão')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'))
            ->setEmptyOption('Escolha um recurso');

        $prmNome = new Element\Text('prmNome');
        $prmNome->setName('prmNome')
            ->setAttribute('id', 'prmNome')
            ->setAttribute('placeholder', 'Nome da permissão')
            ->setAttribute('class', 'form-control')
            ->setLabel('Nome da permissão')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $prmDescricao = new Element\Text('prmDescricao');
        $prmDescricao->setName('prmDescricao')
            ->setAttribute('id', 'prmDescricao')
            ->setAttribute('placeholder', 'Descrição da permissão')
            ->setAttribute('class', 'form-control')
            ->setLabel('Descrição da permissão')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $prmIcone = new Element\Text('prmIcone');
        $prmIcone->setName('prmIcone')
            ->setAttribute('id', 'prmIcone')
            ->setAttribute('placeholder', 'Ícone do módulo')
            ->setAttribute('class', 'form-control')
            ->setLabel('Ícone do módulo')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $submit = new Element\Submit('submit');
        $submit->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-info');

        $this->add($prmId)
            ->add($prmModulo)
            ->add($prmRcs)
            ->add($prmNome)
            ->add($prmDescricao)
            ->add($submit);
    }
}