<?php

namespace Admin;

return array(
    'service_manager' => array(
        'factories' => array(
            'Admin\Model\SegUsuariosModel' => 'Admin\Model\Factory\SegUsuariosModelFactory',
            'Admin\Model\SegModulosModel' => 'Admin\Model\Factory\SegModulosModelFactory'
        )
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);