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
        // Validate all parameters
        if (!array_key_exists('oml-zf2-theme-manager', $config)) {
        	throw new \Exception('Missing configuration parameter for "oml-zf2-theme-manager"');
        }
        $themeConfig = $config['oml-zf2-theme-manager'];
        if (!array_key_exists('active_theme', $themeConfig)) {
        	throw new Exception('There must be atleast one active theme set for "oml-zf2-theme-manager"');	
        }
        /**
         * If specified active theme is not present in list of available theme, throw an exception
         */
        $activeThemeName = $themeConfig['active_theme'];
        $activeThemeIsAvailable = false;
        foreach ($themeConfig['themes'] as $themeName => $config) {
            if ($activeThemeName == $themeName) {
                $activeThemeIsAvailable = true;
            }
        }
        if (false === $activeThemeIsAvailable) {
            throw new \Exception('Specified active theme is not available in theme list');
        }
        $manager = new ThemeManager($serviceLocator, $themeConfig);
        return $manager;
    }
}
