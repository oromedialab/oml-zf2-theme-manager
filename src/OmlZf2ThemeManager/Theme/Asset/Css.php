<?php

namespace OmlZf2ThemeManager\Theme\Asset;

use OmlZf2ThemeManager\Theme\Asset\Asset;
use OmlZf2ThemeManager\Theme\Asset\AssetInterface;

class Css extends Asset implements AssetInterface
{
	protected $href;

	protected $params;

	public function __construct($type, $params)
	{
		parent::__construct();
		$this->fromArray($params);
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

	public function setParams($params)
	{
		$this->params = $params;
		return $this;
	}

	public function getParams()
	{
		return $this->params;
	}
}
