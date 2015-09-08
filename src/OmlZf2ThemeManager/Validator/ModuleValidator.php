<?php
/**
 * OmlZf2ThemeManager - Module Config Validator
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Validator;

use OmlZf2ThemeManager\Initializer\ModuleInitializer;

class ModuleValidator
{
    protected $moduleInitializer;

    public function __construct(ModuleInitializer $moduleInitializer)
    {
        $this->moduleInitializer = $moduleInitializer;
    }

    public function isValid()
    {
        return $this->validate();
    }

    protected function validate()
    {
        $moduleConfig = $this->moduleInitializer->getConfig();

        // Validate Active Theme (active_theme)
        if (!array_key_exists('active_theme', $moduleConfig) || empty($moduleConfig['active_theme'])) {
            throw new \Exception('Active theme not set, there must be one active theme set');
        }

        if (!is_string(($moduleConfig['active_theme']))) {
            throw new \Exception('Active theme must be in string format, '.gettype($moduleConfig['active_theme']).' given');
        }

        // Validate themes
        if (!is_array($moduleConfig['themes']) || empty($moduleConfig['themes'])) {
            throw new \Exception('Theme must be in array format and must not be empty');
        }

        if (count($moduleConfig['themes']) < 1) {
            throw new \Exception('There must be minimum 1 theme defined');
        }

        $activeThemeIsVailableInThemes = false;

        foreach ($moduleConfig['themes'] as $theme) {
            if (!is_array($theme)) {
                throw new \Exception('themes must be in array format');
            }
            if (!array_key_exists('name', $theme) || empty($theme['name']) || !is_string($theme['name'])) {
                throw new \Exception('Missing or invalid theme name');
            }
            if (!array_key_exists('identifier', $theme) || empty($theme['identifier']) || !is_string($theme['identifier'])) {
                throw new \Exception('Missing or invalid idetifier'.$theme['name']);
            }
            if (!array_key_exists('theme_path', $theme) || empty($theme['theme_path']) || !is_string($theme['theme_path'])) {
                throw new \Exception('Missing or invalid theme_path for theme '.$theme['name']);
            }
            if ($theme['identifier'] == $moduleConfig['active_theme']) {
                $activeThemeIsVailableInThemes = true;
            }
        }

        // Validate if active theme is available in themes
        if (false === $activeThemeIsVailableInThemes) {
            throw new \Exception('Active theme is not available in themes');
            
        }

        return true;
    }

    public function getConfigData()
    {
        return $this->moduleInitializer->getConfig();
    }
}

