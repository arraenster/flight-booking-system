<?php
namespace Inventory;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Inventory Module
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Dependency injection to controllers
     *
     * @return array
     */
    public function getControllerConfig()
    {
        return array(
            'initializers' => array(
                function ($instance, $sm) {

                    $locator = $sm->getServiceLocator();
                    $instance->sm = $locator;
                }
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}