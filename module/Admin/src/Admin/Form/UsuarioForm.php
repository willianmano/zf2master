<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class UsuarioForm extends Form
{
    public function __construct()
    {
        parent::__construct('novoUsuario');

        $this->setAttribute('method', 'post');
        $this->setAttribute('class','form-horizontal');
        $this->setAttribute('role','form');
        $this->setAttribute('action', '/admin/usuarios/create');

        $usrId = new Element\Hidden('usrId');

        $usrNome = new Element\Text('usrNome');
        $usrNome->setName('usrNome')
            ->setAttribute('id', 'usrNome')
            ->setAttribute('placeholder', 'Nome do usuário')
            ->setAttribute('class', 'form-control')
            ->setLabel('Nome do usuário')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $usrEmail = new Element\Text('usrEmail');
        $usrEmail->setName('usrEmail')
            ->setAttribute('id', 'usrEmail')
            ->setAttribute('placeholder', 'E-mail')
            ->setAttribute('class', 'form-control')
            ->setLabel('E-mail')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $usrTelefone = new Element\Text('usrTelefone');
        $usrTelefone->setName('usrTelefone')
            ->setAttribute('id', 'usrTelefone')
            ->setAttribute('placeholder', 'Telefone')
            ->setAttribute('class', 'form-control')
            ->setLabel('Telefone')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $usrUsuario= new Element\Text('usrUsuario');
        $usrUsuario->setName('usrUsuario')
            ->setAttribute('id', 'usrUsuario')
            ->setAttribute('placeholder', 'Usuário de login')
            ->setAttribute('class', 'form-control')
            ->setLabel('Usuário de login')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $usrSenha = new Element\Password('usrSenha');
        $usrSenha->setName('usrSenha')
            ->setAttribute('placeholder', 'Senha')
            ->setAttribute('class', 'form-control')
            ->setLabel('Senha')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'));

        $usrAtivo = new Element\Select('usrAtivo');
        $usrAtivo->setName('usrAtivo')
            ->setAttribute('class', 'form-control')
            ->setLabel('Ativo')
            ->setLabelAttributes(array('class'=>'col-sm-3 control-label'))
            ->setValueOptions(array(
                '' => '',
                '0' => 'Não',
                '1' => 'Sim'
            ));

        $submit = new Element\Submit('submit');
        $submit->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-info');

        $this->add($usrId)
            ->add($usrNome)
            ->add($usrEmail)
            ->add($usrTelefone)
            ->add($usrUsuario)
            ->add($usrSenha)
            ->add($usrAtivo)
            ->add($submit);
    }
}