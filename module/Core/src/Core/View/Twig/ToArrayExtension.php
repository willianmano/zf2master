<?php

namespace Core\View\Twig;

class ToArrayExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('to_array', array($this, 'to_array'))
        );
    }

    public function to_array($object)
    {
        if(is_array($object) && count($object)) {
            foreach ( $object as $obj) {
                if($obj instanceof \Core\Entity\BaseEntity) {
                    $returnArray[] = $obj->getArrayCopy();
                } else {
                    $returnArray[] = get_object_vars($obj);
                }
            }
            return $returnArray;
        }

        return get_object_vars($object);
    }

    public function getName()
    {
        return 'to_array_extension';
    }
}