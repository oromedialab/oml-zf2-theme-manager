<?php

namespace OmlZf2ThemeManager;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

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
        // echo '<pre>';
        // print_r($serviceManager->get('config'));
        // die;
    }

    public function getConfig()
    {
        return array_merge_recursive(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/navigation.config.php',
            include __DIR__ . '/config/theme.config.php'
        );
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
