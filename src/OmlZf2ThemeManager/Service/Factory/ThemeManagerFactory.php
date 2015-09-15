<?php
/**
 * OmlZf2ThemeManager - Factory Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use OmlZf2ThemeManager\Resolver\ThemeResolver;

class ThemeManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $appConfig = $serviceLocator->get('config');

        if (!array_key_exists('oml-zf2-theme-manager', $appConfig)) {
        	throw new \Exception('Missing configuration parameter for "oml-zf2-theme-manager"');
        }

        $themeManagerService = $serviceLocator->get('omlzf2.theme.manager.service')->init();

        $themeResolver = new ThemeResolver($serviceLocator, $themeManagerService);
        $themeResolver->resolve();

        return $themeManagerService;
    }
}
