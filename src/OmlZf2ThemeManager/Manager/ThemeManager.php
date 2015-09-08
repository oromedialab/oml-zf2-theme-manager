<?php
/**
 * OmlZf2ThemeManager - ThemeManager Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Manager;

use Zend\ServiceManager\ServiceLocatorInterface;
use OmlZf2ThemeManager\Theme;
use OmlZf2ThemeManager\Collection\ThemeCollection;
use OmlZf2ThemeManager\Validator\ThemeValidator;
use OmlZf2ThemeManager\Resolver\TemplateResolver;
use OmlZf2ThemeManager\Initializer\ModuleInitializer;

class ThemeManager
{
    /**
     * Initialize & validate configuration
     */
    public function __construct(ServiceLocatorInterface $serviceManager, ModuleInitializer $moduleInitializer)
    {
        $themes = $moduleInitializer->getThemes();
        $themeCollection = new ThemeCollection;
        $activeTheme = null;
        foreach($themes as $themeOptions) {
            $theme = new Theme($themeOptions);
            $themeValidator = new ThemeValidator($theme);
            if ($themeValidator->isValid()) {
                $themeCollection->add($theme);   
                if ($themeOptions['identifier'] == $moduleInitializer->getActiveThemeIdentifier()) {
                    $activeTheme = $theme;
                }
            }            
        }
        $templateResolver = new TemplateResolver($serviceManager, $activeTheme);
        return $templateResolver->resolve();
    }
}
