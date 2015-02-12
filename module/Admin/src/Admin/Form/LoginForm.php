<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct('login');

        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/admin/auth/login');

        $usrUsuario = new Element\Text('usrUsuario');
        $usrUsuario->setName('usrUsuario')
            ->setAttribute('id', 'usrUsuario')
            ->setAttribute('placeholder', 'Usuário')
            ->setAttribute('class', 'form-control')
            ->setLabel('Usuário')
            ->setLabelAttributes(array('class'=>'col-sm-12 control-label'));

        $usrSenha = new Element\Password('usrSenha');
        $usrSenha->setName('usrSenha')
            ->setAttribute('id', 'usrSenha')
            ->setAttribute('class', 'form-control')
            ->setLabel('Senha')
            ->setLabelAttributes(array('class'=>'col-sm-12 control-label'));

        $submit = new Element\Submit('submit');
        $submit->setAttribute('value', 'Salvar')
            ->setAttribute('class', 'btn btn-info');

        $this->add($usrUsuario)
            ->add($usrSenha)
            ->add($submit);
    }
}