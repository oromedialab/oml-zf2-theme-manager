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
use OmlZf2ThemeManager\Initializer\ModuleInitializer;
use OmlZf2ThemeManager\Validator\ModuleValidator;
use OmlZf2ThemeManager\Manager\ThemeManager;


class ThemeManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $appConfig = $serviceLocator->get('config');
        if (!array_key_exists('oml-zf2-theme-manager', $appConfig)) {
        	throw new \Exception('Missing configuration parameter for "oml-zf2-theme-manager"');
        }
        $moduleInitializer = new ModuleInitializer($appConfig['oml-zf2-theme-manager']);
        $moduleValidator = new ModuleValidator($moduleInitializer);
        if ($moduleValidator->isValid()) {
            $manager = new ThemeManager($serviceLocator, $moduleInitializer);
            return $manager;
        }
    }
}
