<?php
/**
 * OmlZf2ThemeManager - ThemeResolver Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager;

use Zend\ServiceManager\ServiceLocatorInterface;
use OmlZf2ThemeManager\ThemeHydrator;

class ThemeResolver
{
    protected $themeHydrator;

    protected $serviceManager;

    public function __construct(ServiceLocatorInterface $serviceManager, ThemeHydrator $themeHydrator)
    {
        $this->themeHydrator = $themeHydrator;
        $this->serviceManager = $serviceManager;
    }

    /**
     * Resolve theme config
     */
    public function resolve()
    {
        $config = $this->getConfig();
        $viewResolver = $this->serviceManager->get('ViewResolver');
        $themeResolver = new \Zend\View\Resolver\AggregateResolver();
        if (isset($config['template_map'])) {
            $viewResolverMap = $this->serviceManager->get('ViewTemplateMapResolver');
            $viewResolverMap->add($config['template_map']);
            $templateMapResolver = new \Zend\View\Resolver\TemplateMapResolver($config['template_map']);
            $themeResolver->attach($templateMapResolver);
        }
        if (isset($config['template_path_stack'])) {
            $viewResolverPathStack = $this->serviceManager->get('ViewTemplatePathStack');
            $viewResolverPathStack->addPaths($config['template_path_stack']);
            $pathResolver = new \Zend\View\Resolver\TemplatePathStack(array(
                'script_paths' => $config['template_path_stack']
            ));
            $defaultPathStack = $this->serviceManager->get('ViewTemplatePathStack');
            $pathResolver->setDefaultSuffix($defaultPathStack->getDefaultSuffix());
            $themeResolver->attach($pathResolver);
        }
        $viewResolver->attach($themeResolver, 100);
        return true;
    }

    protected function getThemeHydrator()
    {
        return $this->themeHydrator;
    }

    protected function getConfig()
    {
        $templatePath = $this->themeHydrator->getTemplatePath();
        return include $templatePath.'/config.php';
    }
}
