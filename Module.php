<?php

namespace OmlZf2ThemeManager;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $application = $e->getApplication();
        $eventManager = $application->getEventManager();
        $serviceManager = $application->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $serviceManager->get('omlzf2.theme.manager.factory');
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'omlzf2.theme.manager.factory' => 'OmlZf2ThemeManager\Service\Factory\ThemeManagerFactory'
            ),
            'invokables' => array(
                'omlzf2.theme.manager.service' => 'OmlZf2ThemeManager\Service\Invokable\ThemeManagerService',
            ),
        );
    }
}
