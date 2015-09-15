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
use Zend\Mvc\MvcEvent;

use OmlZf2ThemeManager\Service\Invokable\ThemeManagerService;
use OmlZf2ThemeManager\Theme\Theme;

class ThemeResolver
{
    protected $serviceManager;

    protected $themeManagerService;

    protected $moduleConfig;

    protected $theme;

    public function __construct(ServiceLocatorInterface $serviceManager, ThemeManagerService $themeManagerService)
    {
        $this->serviceManager = $serviceManager;
        $this->themeManagerService = $themeManagerService;
        $this->moduleConfig = $this->themeManagerService->getModuleConfig();
        $this->theme = $this->themeManagerService->getActiveTheme();
    }

    public function resolve()
    {
        $theme = $this->getTheme();

        // Resolve Template Map
        $themeResolver = new \Zend\View\Resolver\AggregateResolver();
        $templateMap = $this->getTheme()->getTemplateMap();
        $viewResolverMap = $this->serviceLocator()->get('ViewTemplateMapResolver');
        $viewResolverMap->add($templateMap);
        $templateMapResolver = new \Zend\View\Resolver\TemplateMapResolver($templateMap);
        $themeResolver->attach($templateMapResolver);

        // Reolve Template Path Stack
        $templatePathStack = $this->getTheme()->getTemplatePathStack();
        $viewResolverPathStack = $this->serviceLocator()->get('ViewTemplatePathStack');
        $viewResolverPathStack->addPaths($templatePathStack);
        $pathResolver = new \Zend\View\Resolver\TemplatePathStack(array(
            'script_paths' => $templatePathStack
        ));

        // Resolve Path
        $viewResolver = $this->serviceLocator()->get('ViewResolver');
        $defaultPathStack = $this->serviceLocator()->get('ViewTemplatePathStack');
        $pathResolver->setDefaultSuffix($defaultPathStack->getDefaultSuffix());
        $themeResolver->attach($pathResolver);
        $viewResolver->attach($themeResolver, 100);

        // Resolve layout for selected style & switch style
        $sharedEventManager = $this->serviceLocator()->get('view')->getEventManager()->getSharedManager();
        $sharedEventManager->attach(
            'Zend\Stdlib\DispatchableInterface',
            MvcEvent::EVENT_DISPATCH,
            function(MvcEvent $event) {
                // Resolve style layout
                $event->getViewModel()->setTemplate($this->getTheme()->getActiveStyle()->getLayout());
        }, -100);

        return true;
    }

    public function getModuleConfig()
    {
        return $this->moduleConfig;
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
