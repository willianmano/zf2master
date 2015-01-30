<?php

namespace Core\Entity;

abstract class BaseEntity
{
    /**
     * Magic gettter to retrieve properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            $reflection = new \ReflectionProperty($this, $property);
            $reflection->setAccessible($property);
            return $reflection->getValue($this);
        }
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $reflection = new \ReflectionProperty($this, $property);
            $reflection->setAccessible($property);
            $reflection->setValue($this, $value);
        }
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $reflectionClass = new \ReflectionClass($this);
        $attributes  = $reflectionClass->getProperties( \ReflectionProperty::IS_PRIVATE );

        foreach ($attributes as $value) {
            $reflection = new \ReflectionProperty($this, $value->name);
            $reflection->setAccessible($value->name);

            $returnData[$value->name] = $reflection->getValue($this);
        }

        return $returnData;
    }
}