<?php
namespace Inventory;

return array(
    'controllers' => array(
        'invokables' => array(
            'Inventory\Controller\Inventory' => 'Inventory\Controller\InventoryController',
        ),
    ),
    'validators' => array(
        'invokables' => array(
            'FloatValidator' => 'Inventory\Form\Validator\Float'
        ),
    ),
    'router' => array(
        'routes' => array(
            'inventory' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/inventory[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Inventory\Controller\Inventory',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'form_elements' => array(
        'invokables' => array(
            'AddFlightForm' => 'Inventory\Form\AddFlightForm'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'inventory' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'flight_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Inventory/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Inventory\Entity' => 'flight_entity',
                )
            )
        )
    ),
);