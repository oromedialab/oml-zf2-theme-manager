<?php
/**
 * OmlZf2ThemeManager - Module Config
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Initializer;

class ModuleInitializer
{
	protected $config;

	protected $activeTheme;

	protected $themes;

    public function __construct(array $config)
    {
    	$this->config = $config;
    	$this->hydrate($config);
    }

    public function getActiveThemeIdentifier()
    {
    	return $this->activeTheme;
    }

    public function getThemes()
    {
    	return $this->themes;
    }

    public function getConfig()
    {
    	return $this->config;
    }

    protected function hydrate(array $config)
    {
    	if (array_key_exists('active_theme', $config) && is_string($config['active_theme'])) {
    		$this->activeTheme = $config['active_theme'];
    	}
    	if (array_key_exists('themes', $config) && is_array($config['themes'])) {
    		$this->themes = $config['themes'];
    	}
    	return $this;
    }
}
