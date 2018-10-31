<?php
namespace Mirador;
return [
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Mirador\Controller\Container' => Controller\ContainerController::class,
        ],
    ],
    'router' => [
        'routes' => [
            'mirador_container' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/:resourcename/:id/mirador',
                    'constraints' => [
                        'resourcename' => 'item|item\-set',
                        'id' => '\d+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Mirador\Controller',
                        'controller' => 'Container',
                        'action' => 'mirador',
                    ],
                ],
            ],
        ],
    ],
];


