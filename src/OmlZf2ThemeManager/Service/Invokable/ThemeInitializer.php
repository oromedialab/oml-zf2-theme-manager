<?php

namespace OmlZf2ThemeManager\Service\Invokable;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use OmlZf2ThemeManager\Initializer\ModuleInitializer;
use OmlZf2ThemeManager\Validator\ModuleValidator;
use OmlZf2ThemeManager\Collection\ThemeCollection;
use OmlZf2ThemeManager\Validator\ThemeValidator;
use OmlZf2ThemeManager\Theme;

class ThemeInitializer implements ServiceManagerAwareInterface
{
    protected $moduleInitializer;

    protected $themeCollection;

    protected $activeTheme;

    protected $serviceManager;

    public function init()
    {
    	$appConfig = $this->getServiceManager()->get('config');
    	$moduleInitializer = new ModuleInitializer($appConfig['oml-zf2-theme-manager']);
        $moduleValidator = new ModuleValidator($moduleInitializer);
        $activeTheme = null;
        if ($moduleValidator->isValid()) {
        	$themeCollection = new ThemeCollection;
	        foreach($moduleInitializer->getThemes() as $themeOptions) {
	            $theme = new Theme($themeOptions);
	            $themeValidator = new ThemeValidator($theme);
	            if ($themeValidator->isValid()) {
	                $themeCollection->add($theme);
	                if ($themeOptions['identifier'] == $moduleInitializer->getActiveThemeIdentifier()) {
	                    $activeTheme = $theme;
	                }
	            }            
	        }
        }
        $this->moduleInitializer = $moduleInitializer;
        $this->themeCollection = $themeCollection;
        $this->activeTheme = $activeTheme;
    	return $this;
    }

    public function getModuleInitializer()
    {
    	return $this->activeTheme;
    }

    public function getThemeCollection()
    {
    	return $this->themeCollection;
    }

    public function getActiveTheme()
    {
    	return $this->activeTheme;
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}
