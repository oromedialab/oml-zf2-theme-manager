<?php
/**
 * OmlZf2ThemeManager - Style Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */

namespace OmlZf2ThemeManager\Theme;

use OmlZf2ThemeManager\Collection\AssetCollection;

class Style
{
	protected $name;

	protected $identiifer;

	protected $layout;

	protected $assetsRef;

	protected $assetCollection;

	public function __construct(array $options)
	{
		$this->fromArray($options);
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setIdentifier($identiifer)
	{
		$this->identiifer = $identiifer;
		return $this;
	}

	public function getIdentifier()
	{
		return $this->identiifer;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function setAssetsRef($assetsRef)
	{
		$this->assetsRef = $assetsRef;
		return $this;
	}

	public function getAssetsRef()
	{
		return $this->assetsRef;
	}

	public function setAssetCollection(AssetCollection $assetCollection)
	{
		$this->assetCollection = $assetCollection;
		return $this;
	}

	public function getAssetCollection()
	{
		return $this->assetCollection;
	}

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

    public function toArray()
    {
        return get_object_vars($this);
    }
}
