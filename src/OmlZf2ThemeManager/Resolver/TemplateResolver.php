<?php
/**
 * OmlZf2ThemeManager - ThemeResolver Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Resolver;

use Zend\ServiceManager\ServiceLocatorInterface;
use OmlZf2ThemeManager\Theme;

class TemplateResolver
{
    protected $theme;

    protected $serviceManager;

    public function __construct(ServiceLocatorInterface $serviceManager, Theme $theme)
    {
        $this->serviceManager = $serviceManager;
        $this->theme = $theme;
    }

    /**
     * Resolve theme config
     */
    public function resolve()
    {
        $theme = $this->getTheme();
        $viewResolver = $this->serviceLocator()->get('ViewResolver');

        // Resolve Template Map
        $themeResolver = new \Zend\View\Resolver\AggregateResolver();
        $templateMap = $this->getTheme()->getTemplateMap();
        $viewResolverMap = $this->serviceLocator()->get('ViewTemplateMapResolver');
        $viewResolverMap->add($templateMap);
        $templateMapResolver = new \Zend\View\Resolver\TemplateMapResolver($templateMap);
        $themeResolver->attach($templateMapResolver);

        $templatePathStack = $this->getTheme()->getTemplatePathStack();
        $viewResolverPathStack = $this->serviceLocator()->get('ViewTemplatePathStack');
        $viewResolverPathStack->addPaths($templatePathStack);
        $pathResolver = new \Zend\View\Resolver\TemplatePathStack(array(
            'script_paths' => $templatePathStack
        ));
        $defaultPathStack = $this->serviceLocator()->get('ViewTemplatePathStack');
        $pathResolver->setDefaultSuffix($defaultPathStack->getDefaultSuffix());
        $themeResolver->attach($pathResolver);
        $viewResolver->attach($themeResolver, 100);
        return true;
    }

    protected function getTheme()
    {
        return $this->theme;
    }

    protected function serviceLocator()
    {
        return $this->serviceManager;
    }
}
