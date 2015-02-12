<?php

namespace Admin;

return array(
    'controllers' => array(
        'factories' => array(
            'Admin\Controller\Auth' => 'Admin\Controller\Factory\AuthControllerFactory',
            'Admin\Controller\Modulos' => 'Admin\Controller\Factory\ModulosControllerFactory',
            'Admin\Controller\CategoriasRecursos' => 'Admin\Controller\Factory\CategoriasRecursosControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Admin\Service\AuthService' => 'Admin\Service\Factory\AuthServiceFactory',
            'Admin\Service\AuthorizationService' => 'Admin\Service\Factory\AuthorizationServiceFactory',
            'Admin\Model\SegUsuariosModel' => 'Admin\Model\Factory\SegUsuariosModelFactory',
            'Admin\Model\SegModulosModel' => 'Admin\Model\Factory\SegModulosModelFactory',
            'Admin\Model\SegCategoriasRecursosModel' => 'Admin\Model\Factory\SegCategoriasRecursosModelFactory',
            'Session' => function ($serviceManager) {
                return new \Zend\Session\Container('zf2master');
            },
        ),
        'invokables' => array(
            'Admin\Form\LoginForm' => 'Admin\Form\LoginForm',
            'Admin\Form\ModuloForm' => 'Admin\Form\ModuloForm',
            'Admin\Form\Filter\ModuloFormFilter' => 'Admin\Form\Filter\ModuloFormFilter',
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
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'module'        => 'admin'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller][/:action][/:id][/:idtwo]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                                'idtwo'      => '[0-9]+',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),

                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),
    'access_control' => array(
        'preloginopenactions' => array(
            'admin' => array(
                'auth' => array(
                    'index',
                    'login',
                    'logout'
                )
            )
        ),
        'postloginopenactions' => array(
            'admin' => array(
                'index' => array(
                    'test',
                    'index'
                ),
                'perfil' => array(
                    'index',
                    'update',
                    'atualizarsenha'
                ),
            ),
            'application' => array(
                'index' => array(
                    'index'
                )
            )
        ),
    ),
);