<?php
namespace Application;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Main Application Module
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    const VERSION = "1.0";

    public function onBootstrap(MvcEvent $e)
    {

        $sm = $e->getApplication()->getServiceManager();

        $router = $sm->get('router');
        $request = $sm->get('request');

        $matchedRoute = $router->match($request);
        if ($matchedRoute) {
            $params = $matchedRoute->getParams();

            $controller = $params['controller'];
            $action = $params['action'];

            $module_array = explode('\\', $controller);
            $module = array_pop($module_array);

            $route = $matchedRoute->getMatchedRouteName();

            $e->getViewModel()->setVariables(
                array(
                    'CURRENT_MODULE_NAME' => $module,
                    'CURRENT_CONTROLLER_NAME' => $controller,
                    'CURRENT_ACTION_NAME' => $action,
                    'CURRENT_ROUTE_NAME' => $route,
                )
            );
        }
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}