<?php
/**
 * OmlZf2ThemeManager - ThemeHydrator Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager;

class ThemeHydrator
{
    /**
     * Theme Name
     *
     * @var|string
     */
    protected $name = null;

    /**
     * Theme Template Path (Layout/Error)
     *
     * @var|string
     */
    protected $templatePath = null;

    /**
     * Theme Styles (orange, blue, green etc.)
     *
     * @var|string
     */
    protected $styles = false;

    /**
     * Public Asset Path
     *
     * @var|string
     */
    protected $publicAssetPath = null;

    /**
     * Public Directory Path
     *
     * @var|string
     */
    protected $publicDirectoryPath = null;

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
     * Set Template Path
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
        return $this;
    }

    /**
     * Get Template Path
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
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
     * Set Public Directory Path
     */
    public function setPublicDirectoryPath($publicDirectoryPath)
    {
        $this->publicDirectoryPath = $publicDirectoryPath;
        return $this;
    }

    /**
     * Get Public Directory Path
     */
    public function getPublicDirectoryPath()
    {
        return $this->publicDirectoryPath;
    }

    /**
     * Set Theme Styles
     */
    public function setStyles($styles)
    {
        $this->styles = $styles;
        return $this;
    }

    /**
     * Get Theme Styles
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Import from Arrary
     */
    public function fromArray(array $array)
    {
        foreach ($array as $property => $value) {
            $underscoreToCamelCase = new \Zend\Filter\Word\UnderscoreToCamelCase();
            $method = 'set'.$underscoreToCamelCase->filter($property);
            $this->$method($value);
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
