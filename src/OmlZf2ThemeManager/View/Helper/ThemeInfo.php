<?php
namespace OmlZf2ThemeManager\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ThemeInfo extends AbstractHelper
{
    protected $activeThemeName;

	protected $activeThemeConfig;

    protected $moduleConfig;

    protected $themeConfig;

    public function __invoke()
    {
        $sm = $this->getServiceLocator();
    	$moduleConfig = $sm->get('config');
        $this->moduleConfig = $moduleConfig;
    	$themeConfig = $moduleConfig['oml-zf2-theme-manager'];
        $this->themeConfig = $themeConfig;
    	return $this;		
    }

    public function init($param)
    {
        if ('active.theme' == $param) {
            $themeConfig = $this->getThemeConfig();
            $activeThemeName = $themeConfig['active'];
            foreach ($themeConfig['themes'] as $themeName => $config) {
                if ($activeThemeName == $themeName) {
                    $this->activeThemeName = $themeName;
                    $this->activeThemeConfig = $config;
                }
            }
        }
		return $this;
    }

    public function get($param)
    {
        $result = null;
        if (empty($this->activeThemeName)) {
            throw new \Exception('Active theme is not set');
        }
        switch ($param) {
            case 'name':
                $result = $this->activeThemeConfig['name'];
                break;
            case 'template.path':
                $result = $this->activeThemeConfig['template_path'];
                break;
            case 'public.asset.path':
                $result = $this->activeThemeConfig['public_asset_path'];
                break;
        }
        return $result;
    }

    public function getServiceLocator()
    {
        return $this->getView()->getHelperPluginManager()->getServiceLocator();
    }

    protected function getModuleConfig()
    {
        return $this->moduleConfig;
    }

    protected function getThemeConfig()
    {
        return $this->themeConfig;
    }
}
