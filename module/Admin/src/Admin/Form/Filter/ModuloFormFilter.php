<?php

namespace Admin\Form\Filter;

use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class ModuloFormFilter extends InputFilter
{
    public function prepareFilters()
    {
        $modNome = new Input('modNome');
        $modNome->getFilterChain()
               ->attachByName('StripTags')
               ->attachByName('StringTrim');
		$modNome->getValidatorChain()
               ->attachByName('NotEmpty')
               ->attachByName('StringLength', array('min' => 1, 'max' => 150, 'encoding' => 'utf-8'));

        $modDescricao = new Input('modDescricao');
        $modDescricao->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $modDescricao->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 1, 'max' => 150, 'encoding' => 'utf-8'));

        $modIcone = new Input('modIcone');
        $modIcone->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $modIcone->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 1, 'max' => 45, 'encoding' => 'utf-8'));

        $this->add($modNome)
             ->add($modDescricao)
             ->add($modIcone);
    }
}