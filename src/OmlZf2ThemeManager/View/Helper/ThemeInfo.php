<?php
namespace OmlZf2ThemeManager\View\Helper;

use Zend\View\Helper\AbstractHelper;
use OmlZf2ThemeManager\ThemeHydrator;

class ThemeInfo extends AbstractHelper
{
    protected $activeThemeName;

	protected $activeThemeConfig;

    protected $moduleConfig;

    protected $themeConfig;

    protected $style = false;

    protected $themeHydrator;

    public function __invoke()
    {
        $sm = $this->getServiceLocator();
    	$moduleConfig = $sm->get('config');
        $this->moduleConfig = $moduleConfig;
    	$themeConfig = $moduleConfig['oml-zf2-theme-manager'];
        $this->themeConfig = $themeConfig;
        /**
         * Set Active Theme
         */
        $activeThemeName = $themeConfig['active_theme'];
        foreach ($themeConfig['themes'] as $themeName => $config) {
            if ($activeThemeName == $themeName) {
                $this->activeThemeName = $themeName;
                $this->activeThemeConfig = $config;
                $themeHyrdator = new ThemeHydrator;
                $themeHyrdator->fromArray($config);
                $themeHyrdator->setPublicDirectoryPath($themeConfig['public_directory_path']);
                $this->themeHyrdator = $themeHyrdator;
                break;
            }
        }
    	return $this;
    }


    public function get($param)
    {
        $result = null;
        if (empty($this->activeThemeConfig)) {
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
            case 'css.styles':
                $themeHyrdator = $this->getThemeHydrator();
                $themeConfig = $themeHyrdator->getConfig();
                // Validate if styles param exist for active theme
                if (!array_key_exists('styles', $themeConfig)) {
                    throw new \Exception('Styles are not available for the selected theme');
                }
                if (!is_array($themeConfig['styles'])) {
                    throw new \Exception('Invalid configuration defined for styles, configuration parameters must be array, '.
                        gettype($this->activeThemeConfig['styles'].' detected'
                    ));
                }
                $stylesConfig = $themeConfig['styles'];
                // Validate if active style exist
                if (!array_key_exists('active_style', $stylesConfig)) {
                    throw new \Exception('No active styles defined for the theme');
                }
                if (!array_key_exists('active_style', $stylesConfig)) {
                    throw new \Exception('Active style not found');
                }
                $activeStyle = $stylesConfig['active_style'];
                // Validate if styles list exist
                if (!array_key_exists('list', $stylesConfig) || !is_array($stylesConfig['list'])) {
                    throw new \Exception('Invalid or missing styles list');
                }
                $stylesList = $stylesConfig['list'];
                // Fetch css list for active style
                $activeStyleIsAvailableInStyleList = false;
                $cssListForActiveStyle = array();
                foreach ($stylesList as $styleName => $value) {
                    if($styleName == $activeStyle) {
                        $activeStyleIsAvailableInStyleList = true;
                        $cssListForActiveStyle = $value['load_assets']['css'];
                        break;
                    }
                }
                // Validate active_style in style list
                if (false === $activeStyleIsAvailableInStyleList) {
                    throw new \Exception('Style with identifier "'.$activeStyle.'" not found in style list');
                }

                if (!array_key_exists('styles_asset_path', $stylesConfig)) {
                    throw new \Exception('Undefined styles asset path');
                }
                $styleAssetPath = $stylesConfig['styles_asset_path'];
                $result = array(
                    'css' => $cssListForActiveStyle,
                    'styles_asset_path' => $styleAssetPath
                );
                break;
        }
        return $result;
    }

    public function headLink()
    {
        
    }

    public function headScript()
    {

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

    protected function getThemeHydrator()
    {
        return $this->themeHyrdator;
    }
}
