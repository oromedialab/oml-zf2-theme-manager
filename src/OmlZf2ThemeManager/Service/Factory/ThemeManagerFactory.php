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
use OmlZf2ThemeManager\ThemeManager;

class ThemeManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        if (!array_key_exists('oml-zf2-theme', $config)) {
        	throw new \Exception('Missing configuration parameter for "oml-zf2-theme-manager"');
        }
        $themeConfig = $config['oml-zf2-theme'];
        if (!array_key_exists('active', $themeConfig)) {
        	throw new Exception('There must be atleast one active theme set for "oml-zf2-theme-manager"');	
        }
        $manager = new ThemeManager($serviceLocator, $themeConfig);
        return $manager;
    }
}
