<?php
/**
 * OmlZf2ThemeManager - Style Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */

namespace OmlZf2ThemeManager;

use OmlZf2ThemeManager\Asset;
use OmlZf2ThemeManager\Collection\AssetCollection;

class Style
{
	protected $name;

	protected $identiifer;

	protected $logo;

	protected $assetCollection;

	public function __construct(array $options)
	{
		$this->fromArray($options);
		$this->loadAssetCollection($options);
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

	public function setLogo($logo)
	{
		$this->logo = $logo;
		return $this;
	}

	public function getLogo()
	{
		return $this->logo;
	}

	public function setAssetCollection(AssetCollection $assetCollection)
	{
		$this->assetCollection[] = $assetCollection;
		return $this;
	}

	public function getAssetCollection()
	{
		return $this->assetCollection;
	}

	public function loadAssetCollection(array $options)
	{
		$assetCollection = new AssetCollection();
		if (array_key_exists('assets', $options) && !empty($options['assets']) && is_array($options['assets'])) {
			$assets = $options['assets'];
			$cssAssets = array_key_exists('css', $assets) && !empty($assets['css']) && is_array($assets['css']) ? $assets['css'] : array();
			foreach ($cssAssets as $cssAsset) {
				$asset = new Asset('css', $cssAsset);
				$assetCollection->add($asset);
			}
		}
		$this->assetCollection = $assetCollection;
		return $this;
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
