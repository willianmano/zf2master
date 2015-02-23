<?php

namespace Admin\Form\Filter;

use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class UsuarioFormFilter extends InputFilter
{
    public function prepareFilters()
    {
        $usrNome = new Input('usrNome');
        $usrNome->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $usrNome->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 1, 'max' => 150, 'encoding' => 'utf-8'));

        $usrEmail = new Input('usrEmail');
        $usrEmail->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $usrEmail->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('EmailAddress')
            ->attachByName('StringLength', array('min' => 1, 'max' => 150, 'encoding' => 'utf-8'));

        $usrTelefone = new Input('usrTelefone');
        $usrTelefone->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $usrTelefone->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 1, 'max' => 15));

        $usrUsuario = new Input('usrUsuario');
        $usrUsuario->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $usrUsuario->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 4, 'max' => 45));

        $usrSenha = new Input('usrSenha');
        $usrSenha->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $usrSenha->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 4, 'max' => 15));

        $usrAtivo = new Input('usrAtivo');
        $usrAtivo->getValidatorChain()
            ->attachByName('NotEmpty');

        $this->add($usrNome)
            ->add($usrEmail)
            ->add($usrTelefone)
            ->add($usrUsuario)
            ->add($usrSenha)
            ->add($usrAtivo);
    }
}