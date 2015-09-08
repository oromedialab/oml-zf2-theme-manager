<?php
/**
 * OmlZf2ThemeManager - Theme Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager;

use OmlZf2ThemeManager\Style;
use OmlZf2ThemeManager\Collection\StyleCollection;
use OmlZf2ThemeManager\Collection\AssetCollection;

class Theme
{
    /**
     * Theme Name
     *
     * @var|string
     */
    protected $name;

    /**
     * Theme Identifier
     *
     * @var|string
     */
    protected $identifier;

    /**
     * Theme Path
     *
     * @var|string
     */
    protected $themePath;

    /**
     * Template Map
     *
     * @var|array
     */
    protected $templateMap;

    /**
     * Template Path Stack (Layout/Error)
     *
     * @var|array
     */
    protected $templatePathStack;

    /**
     * Public Asset Path
     *
     * @var|string
     */
    protected $publicAssetPath;

    /**
     * Theme Style Collection (orange, blue, green etc.)
     *
     * @var|obj
     */
    protected $styleCollection;

    /**
     * Active Style
     *
     * @var|obj
     */
    protected $activeStyle;

    /**
     * Asset Collection (css, js etc.)
     *
     * @var|obj
     */
    protected $assetCollection;

    public function __construct(array $option)
    {
        $this->fromArray($option);
        $options = array_merge_recursive($option, $this->getConfig());
        $this->fromArray($options);
        $this->loadStyle();
        $this->loadAsset();
    }

    /**
     * Set Theme Name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get Theme Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Theme Identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Get Theme Identifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set Theme Path
     */
    public function setThemePath($themePath)
    {
        $this->themePath = $themePath;
        return $this;
    }

    /**
     * Get Theme Path
     */
    public function getThemePath()
    {
        return $this->themePath;
    }

    /**
     * Set Template Map
     */
    public function setTemplateMap($templateMap)
    {
        $this->templateMap = $templateMap;
        return $this;
    }

    /**
     * Get Template Map
     */
    public function getTemplateMap()
    {
        return $this->templateMap;
    }

    /**
     * Set Template Path Stack
     */
    public function setTemplatePathStack($templatePathStack)
    {
        $this->templatePathStack = $templatePathStack;
        return $this;
    }

    /**
     * Get Template Path Stack
     */
    public function getTemplatePathStack()
    {
        return $this->templatePathStack;
    }

    /**
     * Set Public Asset Path
     */
    public function setPublicAssetPath($publicAssetPath)
    {
        $this->publicAssetPath = $publicAssetPath;
        return $this;
    }

    /**
     * Get Public Asset Path
     */
    public function getPublicAssetPath()
    {
        return $this->publicAssetPath;
    }

    /**
     * Set Theme Style Collection
     */
    public function setStyleCollection(StyleCollection $styleCollection)
    {
        $this->styleCollection = $styleCollection;
        return $this;
    }

    /**
     * Get Style Collection
     */
    public function getStyleCollection()
    {
        return $this->styleCollection;
    }

    /**
     * Load Style Collection
     */
    public function loadStyle()
    {
        $config = $this->getMergedConfig();
        $styleCollection = new StyleCollection();
        // If style exist for theme
        if (array_key_exists('style', $config)) {
            $activeStyleIdentifier = array_key_exists('active', $config['style']) ? $config['style']['active'] : null;
            $activeStyle = null;
            foreach ($config['style']['collection'] as $styleConfig) {
                $style = new Style($styleConfig);
                $styleCollection->add($style);
                if ($activeStyleIdentifier == $styleConfig['identifier']) {
                    $activeStyle = $style;
                }
            }
            $this->setActiveStyle($activeStyle);
        }
        $this->styleCollection = $styleCollection;
        return $this;
    }

    /**
     * Load Asset Collection
     */
    public function loadAsset()
    {
        $config = $this->getMergedConfig();
        $assetCollection = new AssetCollection;
        $assets = array_key_exists('assets', $config) && !empty($config['assets']) && is_array($config['assets']) ? $config['assets'] : array();
        $cssAssets = array_key_exists('css', $assets) && !empty($assets['css']) && is_array($assets['css']) ? $assets['css'] : array();
        $jsAssets = array_key_exists('js', $assets) && !empty($assets['js']) && is_array($assets['js']) ? $assets['js'] : array();
        foreach ($cssAssets as $resource) {
            $asset = new Asset('css', $resource);
            $assetCollection->add($asset);
        }
        foreach ($jsAssets as $resource) {
            $asset = new Asset('js', $resource);
            $assetCollection->add($asset);
        }
        $favIcon = array_key_exists('favicon', $assets) ? $assets['favicon'] : null;
        if (null != $favIcon) {
            $asset = new Asset('favicon', $favIcon);
            $assetCollection->add($asset);
        }
        $this->assetCollection = $assetCollection;
        return $this;
    }

    /**
     * Set Active Style
     */
    public function setActiveStyle(Style $style)
    {
        $this->activeStyle = $style;
        return $this;
    }

    /**
     * Get Active Style
     */
    public function getActiveStyle()
    {
        return $this->activeStyle;
    }

    /**
     * Set Asset Collection
     */
    public function setAssetCollection(AssetCollection $assetCollection)
    {
        $this->assetCollection = $assetCollection;
        return $this;
    }

    /**
     * Get Asset Collection
     */
    public function getAssetCollection()
    {
        return $this->assetCollection;
    }

    /**
     * Get Theme Config
     */
    public function getConfig()
    {
        $templatePath = $this->getThemePath();
        return include $templatePath.'/config.php';
    }

    /**
     * Import from Arrary
     */
    public function fromArray(array $array)
    {
        foreach ($array as $property => $value) {
            $underscoreToCamelCase = new \Zend\Filter\Word\UnderscoreToCamelCase();
            $method = 'set'.$underscoreToCamelCase->filter($property);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getMergedConfig()
    {
        return array_merge_recursive($this->toArray(), $this->getConfig());
    }

    /**
     * Properties to Array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
