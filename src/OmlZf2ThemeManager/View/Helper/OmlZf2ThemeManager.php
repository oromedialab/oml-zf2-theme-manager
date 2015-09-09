<?php
/**
 * OmlZf2ThemeManager - View Helper Class for Theme Manager
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\View\Helper;

use Zend\View\Helper\AbstractHelper;
use OmlZf2ThemeManager\Core\Utility;

class OmlZf2ThemeManager extends AbstractHelper
{
    protected $themeinitializer;

    protected $activeTheme;

    public function __invoke()
    {
        $sm = $this->getServiceLocator();
        $this->themeinitializer = $sm->get('omlzf2.themeinitializer')->init();
        $this->activeTheme = $this->themeinitializer->getActiveTheme();
        return $this;
    }

    public function headTitle($title = null)
    {
        return $this->getView()->headTitle($title);
    }

    public function headMeta()
    {
        return $this->getView()->headMeta();
    }

    public function headLink()
    {
        $theme = $this->getActiveTheme();
        $assetCollection = $theme->getAssetCollection()->fetchAll();
        foreach ($assetCollection as $asset) {
            if('css' === $asset->getType()) {
                $resource = $this->getView()->basePath($theme->getPublicAssetPath()).$asset->getResource();
                $this->getView()->headLink()->appendStylesheet($resource);
            }
            if('favicon' === $asset->getType()) {
                $resource = array();
                if (is_array($asset->getResource())) {
                    foreach ($asset->getResource() as $rel => $href) {
                        $resource = array('rel' => $rel, 'href' => $this->getView()->basePath($theme->getPublicAssetPath()).$href);
                        $this->getView()->headLink($resource);
                    }
                }
            }
        }
        // Apply CSS from styles if available
        if ($theme->hasStyle()) {
            $activeStyle = $theme->getActiveStyle();
            $assets = $activeStyle->getAssetCollection()->fetchAll();
            foreach ($assets as $asset) {
                if('css' === $asset->getType()) {
                    $resource = $this->getView()->basePath($theme->getStyleAssetPath()).$asset->getResource();
                    $this->getView()->headLink()->appendStylesheet($resource);
                }
            }
        }
        return $this->getView()->headLink();
    }

    public function headStyle()
    {
        return $this->getView()->headStyle();
    }

    public function headScript()
    {
        $theme = $this->getActiveTheme();
        $assetCollection = $theme->getAssetCollection()->fetchAll();
        foreach ($assetCollection as $asset) {
            $resource = $asset->getResource();
            if('js' === $asset->getType()) {
                if (!is_array($asset->getResource())) {
                    $fileResource = $this->getView()->basePath($theme->getPublicAssetPath()).$resource;
                    $this->getView()->headScript()->appendFile($fileResource);
                }
                if (is_array($resource) && array_key_exists('resource', $resource)) {
                    $fileResource = $this->getView()->basePath($theme->getPublicAssetPath()).$resource['resource'];
                    $args = array_key_exists('args', $resource) ? $resource['args'] : array();
                    $params = array_merge_recursive(array($fileResource), $args);
                    call_user_func_array(array($this->getView()->headScript(), 'appendFile'), $params);
                }
            }
        }
        return $this->getView()->headScript();
    }

    public function logo()
    {
        $theme = $this->getActiveTheme();
        $logo = $this->getView()->basePath($theme->getStyleAssetPath().$theme->getActiveStyle()->getLogo());
        return $logo;
    }

    public function basePath($basePath)
    {
        return $this->getView()->basePath($this->getActiveTheme()->getPublicAssetPath().$basePath);
    }

    public function publicAssetPath()
    {
        return $this->getView()->basePath($this->getActiveTheme()->getPublicAssetPath());
    }

    public function publicDirectoryPath()
    {
        return Utility::PUBLIC_DIRECTORY_PATH();
    }

    public function getActiveTheme()
    {
        return $this->activeTheme;
    }

    public function getThemeInitializer()
    {
        return $this->themeinitializer;
    }

    public function getServiceLocator()
    {
        return $this->getView()->getHelperPluginManager()->getServiceLocator();
    }
}
