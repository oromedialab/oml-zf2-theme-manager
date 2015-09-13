<?php
/**
 * OmlZf2ThemeManager - Theme Initializer Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Service\Invokable;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

use OmlZf2ThemeManager\Config\ModuleConfig;

use OmlZf2ThemeManager\Validator\ModuleConfigValidator;
use OmlZf2ThemeManager\Validator\ThemeValidator;

use OmlZf2ThemeManager\Collection\ThemeCollection;
use OmlZf2ThemeManager\Collection\StyleCollection;
use OmlZf2ThemeManager\Collection\AssetCollection;

use OmlZf2ThemeManager\Theme\Theme;
use OmlZf2ThemeManager\Theme\Style;
use OmlZf2ThemeManager\Theme\Asset\Asset;

class ThemeManagerService implements ServiceManagerAwareInterface
{
    /**
     * Instance of ModuleConfig Class
     *
     * @var|obj
     */
    protected $moduleConfig;

    /**
     * Instance of ThemeCollection Class
     *
     * @var|obj
     */
    protected $themeCollection;

    /**
     * Instance of Active Theme Class
     *
     * @var|obj
     */
    protected $activeTheme;

    /**
     * Zend\ServiceManager Instance
     *
     * @var|obj
     */
    protected $serviceManager;

    /**
     * Init
     */
    public function init()
    {
    	$appConfig = $this->getServiceManager()->get('config');
    	$moduleConfig = new ModuleConfig($appConfig['oml-zf2-theme-manager']);
        $configArray = $moduleConfig->getConfigArray();

        $themeCollection = new ThemeCollection();

        foreach ($configArray['themes'] as $themeConfig) {
            // Intitialize assets for current theme in the loop
            $assetCollection = new AssetCollection();
            foreach ($themeConfig['asset_collection'] as $identifier => $group) {
                foreach ($group as $type => $collection) {
                    foreach ($collection as $assetConfig) {
                        $asset = Asset::init($identifier, $type, $assetConfig);
                        $assetCollection->add($asset);
                    }
                }
            }

            // Intitialize styles for current theme in the loop and set active style
            $styleCollection = new StyleCollection();
            $activeStyle = null;
            foreach ($themeConfig['style_collection'] as $styleConfig) {

                $style = new Style($styleConfig);

                // Set active style
                if ($themeConfig['active_style'] == $styleConfig['identifier']) {
                    $activeStyle = $style;
                }

                // Convert assets_ref to assets_collection
                $styleAssetCollection = new AssetCollection();
                $assetsRef = $styleConfig['assets_ref'];
                foreach ($assetCollection as $asset) {
                    if (in_array($asset->getIdentifier(), $assetsRef)) {
                        $styleAssetCollection->add($asset);
                    }
                }
                $styleCollection->add($style);
                $style->setAssetCollection($styleAssetCollection);
            }

            $theme = new Theme($themeConfig);
            $theme->setAssetCollection($assetCollection);
            $theme->setActiveStyle($activeStyle);
            $theme->setStyleCollection($styleCollection);

            // Set Active Theme
            if ($configArray['active_theme'] == $themeConfig['identifier']) {
                $this->activeTheme = $theme;
            }

            $themeCollection->add($theme);
        }

        $this->themeCollection = $themeCollection;
        return $this;
    }

    public function getModuleConfig()
    {
    	return $this->moduleConfig;
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
