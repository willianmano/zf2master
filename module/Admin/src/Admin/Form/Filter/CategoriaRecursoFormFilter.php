<?php

namespace Admin\Form\Filter;

use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class CategoriaRecursoFormFilter extends InputFilter
{
    public function prepareFilters()
    {
        $ctrNome = new Input('ctrNome');
        $ctrNome->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $ctrNome->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 1, 'max' => 45, 'encoding' => 'utf-8'));

        $ctrIcone = new Input('ctrIcone');
        $ctrIcone->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $ctrIcone->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('StringLength', array('min' => 1, 'max' => 45, 'encoding' => 'utf-8'));

        $ctrOrdem = new Input('ctrOrdem');
        $ctrOrdem->getFilterChain()
            ->attachByName('Int');
        $ctrOrdem->getValidatorChain()
            ->attachByName('NotEmpty')
            ->attachByName('Digits');

        $ctrVisivel = new Input('ctrVisivel');
        $ctrVisivel->getFilterChain()
            ->attachByName('Boolean');
        $ctrVisivel->getValidatorChain()
            ->attachByName('NotEmpty');

        $this->add($ctrNome)
            ->add($ctrIcone)
            ->add($ctrOrdem)
            ->add($ctrVisivel);
    }
}