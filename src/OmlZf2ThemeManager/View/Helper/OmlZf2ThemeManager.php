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
    protected $serviceManager;

    protected $themeinitializer;

    protected $activeTheme;

    protected $activeStyle;

    protected $assetsForActiveStyle;

    public function __invoke()
    {
        $this->serviceManager = $this->getServiceManager();
        $this->themeinitializer = $this->serviceManager->get('omlzf2.theme.manager.service')->init();
        $this->activeTheme = $this->themeinitializer->getActiveTheme();
        $this->activeStyle = $this->activeTheme->getActiveStyle();
        $this->assetsForActiveStyle = $this->activeStyle->getAssetCollection();
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
        foreach ($this->getAssetsForActiveStyle() as $asset) {
            if('css' === $asset->getType()) {
                $href = $this->getView()->basePath($this->publicAssetPath()).$asset->getHref();
                $this->getView()->headLink()->appendStylesheet($href);
            }
            if('favicon' === $asset->getType()) {
                $resource = array('rel' => $asset->getRel(), 'href' => $this->getView()->basePath($this->publicAssetPath()).$asset->getHref());
                $this->getView()->headLink($resource);
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
        foreach ($this->getAssetsForActiveStyle() as $asset) {
            if('js' === $asset->getType()) {
                $href = $this->getView()->basePath($this->publicAssetPath()).$asset->getHref();
                $params = array_merge_recursive(array($href), $asset->getParams());
                call_user_func_array(array($this->getView()->headScript(), 'appendFile'), $params);
            }
        }
        return $this->getView()->headScript();
    }

    public function logo($dimension)
    {
        $logo = null;
        foreach ($this->getAssetsForActiveStyle() as $asset) {
            if('logo' === $asset->getType()) {
                if ($dimension == $asset->getDimension()) {
                    $logo = $this->getView()->basePath($this->publicAssetPath()).$asset->getHref();
                }
            }
        }
        if (null == $logo) {
            throw new \Exception('Logo with dimension "'.$dimension.'" not found for theme "'.$this->getActiveTheme()->getIdentifier().'"');
        }
        return $logo;
    }

    public function getServiceManager()
    {
        return $this->getView()->getHelperPluginManager()->getServiceLocator();
    }

    public function getThemeInitializer()
    {
        return $this->themeinitializer;
    }

    public function getActiveTheme()
    {
        return $this->activeTheme;
    }

    public function getActiveStyle()
    {
        return $this->activeStyle;
    }

    public function getAssetsForActiveStyle()
    {
        return $this->assetsForActiveStyle;
    }

    public function basePath($path)
    {
        return $this->getView()->basePath($this->getActiveTheme()->getPublicAssetPath().$path);
    }

    public function publicAssetPath()
    {
        return $this->getView()->basePath($this->getActiveTheme()->getPublicAssetPath());
    }

    public function publicDirectoryPath()
    {
        return Utility::PUBLIC_DIRECTORY_PATH();
    }
}
