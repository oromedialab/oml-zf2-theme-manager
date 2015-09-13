<?php

namespace OmlZf2ThemeManager\Theme\Asset;

use OmlZf2ThemeManager\Theme\Asset\Asset;
use OmlZf2ThemeManager\Theme\Asset\AssetInterface;

class Logo extends Asset implements AssetInterface
{
	protected $dimension;

	protected $href;

	public function __construct($type, $params)
	{
		parent::__construct();
		$this->fromArray($params);
	}

	public function setDimension($dimension)
	{
		$this->dimension = $dimension;
		return $this;
	}

	public function getDimension()
	{
		return $this->dimension;
	}

	public function setHref($href)
	{
		$this->href = $href;
		return $this;
	}

	public function getHref()
	{
		return $this->href;
	}
}
