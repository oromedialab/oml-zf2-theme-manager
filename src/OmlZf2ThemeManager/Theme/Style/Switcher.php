<?php
/**
 * OmlZf2ThemeManager - Style Switcher Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */

namespace OmlZf2ThemeManager\Theme\Style;

use Zend\ServiceManager\ServiceManager;

use OmlZf2ThemeManager\Config\ModuleConfig;
use OmlZf2ThemeManager\Core\Utility;

class Switcher
{
	protected $serviceManager;

	protected $moduleConfigObj;

	protected $moduleConfigArray = array();

	protected $params = array();

	protected $styleSwitcher = array();

	protected $routesSwitcher = array();

	protected $routeMatchFound = false;

	protected $routeConfig;

	protected $themeIdentifier;

	protected $styleIdentifier;

	public function __construct(ServiceManager $sm, ModuleConfig $moduleConfig)
	{
		$this->serviceManager = $sm;
		$this->moduleConfigObj = $moduleConfig;
		$this->moduleConfigArray = $this->moduleConfigObj->getConfig();
		if (array_key_exists('style_switcher', $this->moduleConfigArray) && is_array($this->moduleConfigArray['style_switcher'])) {
			$this->styleSwitcher = $this->moduleConfigArray['style_switcher'];
		}
		if (!empty($this->styleSwitcher) && array_key_exists('routes', $this->styleSwitcher) && is_array($this->styleSwitcher['routes'])) {
			$this->routesSwitcher = $this->styleSwitcher['routes'];
		}

		$this->params = Utility::getParams($this->serviceManager);
		foreach ($this->routesSwitcher as $route => $config) {
			if ($this->params['matched_route_name'] === $route) {
				$this->routeMatchFound = true;
				$this->routeConfig = $config;
				$this->themeIdentifier = $this->routeConfig['theme'];
				$this->styleIdentifier = $this->routeConfig['style'];
			}
		}
	}

	public function isValid()
	{
		if (!empty($this->themeIdentifier) && 
			!empty($this->styleIdentifier) && 
			true === $this->routeMatchFound &&
			true === $this->validThemeAndStyle($this->themeIdentifier, $this->styleIdentifier)) {
			return true;
		}
		return false;
	}

	protected function validThemeAndStyle($themeIdentifier, $styleIdentifier)
	{
		$themeIsValid = false;
		$styleIsValid = false;
		$mergedConfig = $this->getModuleConfigObj()->getMergedConfig();
		$themesConfig = $mergedConfig['themes'];
		foreach ($themesConfig as $themeConfig) {
			if ($themeConfig['identifier'] === $themeIdentifier) {
				$themeIsValid = true;
			}
			foreach ($themeConfig['style_collection'] as $style) {
				if ($style['identifier'] === $styleIdentifier) {
					$styleIsValid = true;
				}
			}
		}
		return (true === $themeIsValid && true === $styleIsValid) ? true : false;
	}

	public function routeMatchFound()
	{
		return $this->routeMatchFound;
	}

	public function getRouteConfig()
	{
		return $this->routeConfig;
	}

	public function getServiceManager()
	{
		return $this->serviceManager;
	}

	public function getModuleConfigObj()
	{
		return $this->moduleConfigObj;
	}

	public function getModuleConfigArray()
	{
		return $this->moduleConfigArray;
	}

	public function getParams()
	{
		return $this->params;
	}

	public function getStyleSwitcher()
	{
		return $this->styleSwitcher;
	}

	public function getRoutesSwitcher()
	{
		return $this->routesSwitcher;
	}

	public function getThemeIdentifier()
	{
		return $this->themeIdentifier;
	}

	public function getStyleIdentifier()
	{
		return $this->styleIdentifier;
	}

}
