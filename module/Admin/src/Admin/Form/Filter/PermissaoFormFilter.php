<?php

namespace Admin\Form\Filter;

use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class PermissaoFormFilter extends InputFilter
{
    public function prepareFilters()
    {
        $prmRcs = new Input('prmRcs');
        $prmRcs->getFilterChain()
            ->attachByName('Int');
        $prmRcs->getValidatorChain()
            ->attachByName('NotEmpty', array('type' => 'integer'));

        $prmNome = new Input('prmNome');
        $prmNome->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $prmNome->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 3, 'max' => 45, 'encoding' => 'utf-8'));

        $prmDescricao = new Input('prmDescricao');
        $prmDescricao->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $prmDescricao->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 1, 'max' => 300, 'encoding' => 'utf-8'));

        $this->add($prmRcs)
            ->add($prmNome)
            ->add($prmDescricao);
    }
}