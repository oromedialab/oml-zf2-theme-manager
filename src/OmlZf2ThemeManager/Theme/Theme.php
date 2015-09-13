<?php
/**
 * OmlZf2ThemeManager - Theme Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Theme;

use OmlZf2ThemeManager\Collection\StyleCollection;
use OmlZf2ThemeManager\Collection\AssetCollection;

use OmlZf2ThemeManager\Validator\StyleValidator;
use OmlZf2ThemeManager\Validator\AssetValidator;

use OmlZf2ThemeManager\Theme\Style;
use OmlZf2ThemeManager\Theme\Asset;

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
     * Active Style
     *
     * @var|obj
     */
    protected $activeStyle;

    /**
     * Theme Style Collection (orange, blue, green etc.)
     *
     * @var|obj
     */
    protected $styleCollection;

    /**
     * Asset Collection (css, js, favicon etc.)
     *
     * @var|array
     */
    protected $assetCollection;

    protected $skipLoadFromArray = array(
        'active_style',
        'style_collection',
        'asset_collection'
    );

    public function __construct(array $option)
    {
        $this->fromArray($option);
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
     * Import from Arrary
     */
    public function fromArray(array $array)
    {
        foreach ($array as $property => $value) {
            if (in_array($property, $this->skipLoadFromArray)) {
                continue;
            }
            $underscoreToCamelCase = new \Zend\Filter\Word\UnderscoreToCamelCase();
            $method = 'set'.$underscoreToCamelCase->filter($property);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Properties to Array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
