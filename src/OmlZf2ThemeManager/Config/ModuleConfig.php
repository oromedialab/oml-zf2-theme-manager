<?php
/**
 * OmlZf2ThemeManager - Module Config
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Config;

use OmlZf2ThemeManager\Theme;

class ModuleConfig
{
    protected $config;

	protected $mergedConfig;

	protected $activeTheme;

	protected $themes;

    protected $styleSwitcher;

    public function __construct(array $config)
    {
        if (array_key_exists('active_theme', $config) && is_string($config['active_theme'])) {
            $this->activeTheme = $config['active_theme'];
        }
        if (array_key_exists('themes', $config) && is_array($config['themes'])) {
            $this->themes = $config['themes'];
        }
    	$this->config = $config;
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

    public function getStyleSwitcher()
    {
        return $this->styleSwitcher;
    }

    public function getMergedConfig()
    {
    	$moduleConfig = $this->config;
        foreach ($moduleConfig['themes'] as  $index => $config) {
            $themeConfig = include $config['theme_path'].'/config.php';
            $moduleConfig['themes'][$index] = array_merge_recursive($config, $themeConfig);
        }
        return $moduleConfig;
    }
}
