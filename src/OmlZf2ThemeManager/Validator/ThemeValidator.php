<?php
/**
 * OmlZf2ThemeManager - Theme Validator class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Validator;

use OmlZf2ThemeManager\Theme;
use OmlZf2ThemeManager\Core\Utility;

class ThemeValidator
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    protected function validate()
    {
        $this->validateTemplateMap();
        $this->validateTemplatePathStack();
        $this->validatePublicAssetPath();
        $this->validateStyle();
        return true;
    }

    public function isValid()
    {
        return $this->validate();
    }

    protected function validateTemplateMap()
    {
        $templateMap = $this->theme->getTemplateMap();
        if (empty($templateMap) || !is_array($templateMap)) {
            throw new \Exception('Empty or invalid template map type, template map must be in array format');
        }
        $requiredTemplateMaps = array('layout/layout', 'error/404', 'error/index');
        foreach ($requiredTemplateMaps as $requiredTemplateMap) {
            // Check if require template element exist
            if (!array_key_exists($requiredTemplateMap, $templateMap)) {
                throw new \Exception('Invalid or missing template map, ['.$requiredTemplateMap.'] missing from theme "'.$this->theme->getIdentifier().'"');
            }
            // Check if file exist at path
            $templateFile = $templateMap[$requiredTemplateMap];
            if (!file_exists($templateFile)) {
                throw new \Exception('Missing template file ['.$requiredTemplateMap.' => '.$templateFile.'] for theme "'.$this->theme->getIdentifier().'"');
            }
        }
        return $this;
    }

    protected function validateTemplatePathStack()
    {
        $templatePathStacks = $this->theme->getTemplatePathStack();
        if (empty($templatePathStacks) || !is_array($templatePathStacks)) {
            throw new \Exception('Empty or invalid template_path_stack type, template_path_stack must be in array format and must contain at-least one element');
        }
        foreach($templatePathStacks as $identifier => $path) {
            if (!file_exists($path) || !is_dir($path)) {
                throw new \Exception('Invalid or missing path for template_path_stack in theme '.$this->theme->getIdentifier());
            }
        }
        return $this;
    }

    protected function validatePublicAssetPath()
    {
        $publicAssetPath = $this->theme->getPublicAssetPath();
        if (empty($publicAssetPath) || !is_string(($publicAssetPath))) {
            throw new \Exception('Empty or invalid public_asset_path for theme '.$this->theme->getIdentifier());
        }
        $publicDirectoryPath = Utility::PUBLIC_DIRECTORY_PATH();
        if (!file_exists($publicDirectoryPath.$publicAssetPath) || !is_dir($publicDirectoryPath.$publicAssetPath)) {
            throw new \Exception('Invalid or missing path for public_asset_path in theme '.$this->theme->getIdentifier());
        }
        return $this;
    }

    protected function validateStyle()
    {
        $styleCollection = $this->theme->getStyleCollection()->fetchAll();
        if (empty($styleCollection)) {
            throw new \Exception('There must be at-least one style available for a theme, no styles found for theme "'.$this->theme->getIdentifier().'"');
        }
    }
}
