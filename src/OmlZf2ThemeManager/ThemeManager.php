<?php
/**
 * OmlZf2ThemeManager - ThemeManager Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager;

use Zend\ServiceManager\ServiceLocatorInterface;
use OmlZf2ThemeManager\ThemeCollection;
use OmlZf2ThemeManager\ThemeHydrator;
use OmlZf2ThemeManager\ThemeValidator;
use OmlZf2ThemeManager\ThemeResolver;

class ThemeManager
{
    /**
     * Active Theme
     *
     * @var|OmlZf2ThemeManager\ThemeHydrator
     */
    protected $activeTheme = null;

    /**
     * Theme options (as defined in config.php file of theme directory)
     *
     * @var|array
     */
    protected $options = array();

    /**
     * Theme Collections
     *
     * @var|OmlZf2ThemeManager\ThemeCollection
     */
    protected $themeCollection = array();

    /**
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceManager;

    /**
     * Initialize & validate configuration
     */
    public function __construct(ServiceLocatorInterface $serviceManager, $options = array())
    {
        $this->serviceManager = $serviceManager;
        $this->options = $options;
        $activeThemeAvailableInCollection = false;
        if (!isset($options['active'])) {
            throw new \Exception('There must be one active theme set');
        }
        if (!isset($options['themes']) || !is_array($options['themes'])) {
            throw new \Exception('[themes] is not set or not an array');
        }
        if (!array_key_exists('public_directory_path', $options) || !is_dir($options['public_directory_path'])) {
            throw new \Exception('public_directory_path is not defined or invalid directory path');
        }
        $themeCollection = new ThemeCollection;
        foreach ($options['themes'] as $themeName => $themeConfig) {
            $themeHyrdator = new ThemeHydrator;
            $themeHyrdator->fromArray($themeConfig);
            $themeHyrdator->setPublicDirectoryPath($options['public_directory_path']);
            $themeValidator = new ThemeValidator;
            $themeValidator->setThemeHydrator($themeHyrdator);
            if (!$themeValidator->isValid()) {
                throw new Exception('Theme with name '.$themeHyrdator->getName().' has invalid configuration');
            }
            $themeCollection->setThemeHydrator($themeValidator->getThemeHydrator());
            // Assign & ValidateActive Theme
            if ($options['active'] === $themeName) {
                $this->activeTheme = $themeHyrdator;
                $activeThemeAvailableInCollection = true;
            }
        }
        // Throw exception if active theme does not match the collection
        if (false === $activeThemeAvailableInCollection) {
            throw new \Exception('Unable to resolve active theme "'.$options['active'].'" in the collection');
        }
        $this->themeCollection = $themeCollection;
        // Resolve templates for active theme
        $themeResolver = new ThemeResolver($serviceManager, $this->getActiveTheme());
        $themeResolver->resolve();
    }

    public function getThemeCollection()
    {
        return $this->themeCollection;
    }

    public function getActiveTheme()
    {
        return $this->activeTheme;
    }

    protected function getThemeConfig($name)
    {
        return array_key_exists($name, $this->options['themes']) ? $this->options['themes'][$name] : false;
    }
}
