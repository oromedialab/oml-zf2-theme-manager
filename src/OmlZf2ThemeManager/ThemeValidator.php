<?php
/**
 * OmlZf2ThemeManager - ThemeValidator class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager;

use OmlZf2ThemeManager\ThemeHydrator;

class ThemeValidator
{
    protected $themeHydrator = null;

    protected $isValid = false;

    public function setThemeHydrator(ThemeHydrator $themeHydrator)
    {
        $this->themeHydrator = $themeHydrator;
        return $this;
    }

    public function getThemeHydrator()
    {
        return $this->themeHydrator;
    }

    protected function validate()
    {
        $themeHydrator = $this->getThemeHydrator();
        if (null === $themeHydrator) {
            throw new \Exception(__CLASS__.' requires ThemeHydrator to be set in order to validate');
        }
        $themeName = $themeHydrator->getName();
        if (empty($themeName)) {
            throw new \Exception(__NAMESPACE__.' requires "name" and cannot be empty');
        }
        $templatePath = $themeHydrator->getTemplatePath();
        if (empty($templatePath) || !is_dir($templatePath)) {
            throw new \Exception(
                __NAMESPACE__.' requires "template_path" to be valid path to a directory for the theme with name"'.
                $themeHydrator->getName().'" in order to resolve'
            );
        }
        $publicAssetPath = $themeHydrator->getPublicAssetPath();
        $publicDirectoryPath = $themeHydrator->getPublicDirectoryPath();
        if (empty($publicAssetPath) || !is_dir($publicDirectoryPath.'/'.$publicAssetPath)) {
            throw new \Exception(
                __NAMESPACE__.' requires "public_asset_path" and "public_direcory_path" to be valid path to a directory in order to resolve'
            );
        }
        return true;
    }

    public function isValid()
    {
        return $this->validate();
    }
}
