<?php

namespace OmlZf2ThemeManager\Theme\Asset;

use OmlZf2ThemeManager\Theme\Asset\Asset;
use OmlZf2ThemeManager\Theme\Asset\AssetInterface;

class Favicon extends Asset implements AssetInterface
{
	protected $rel;

	protected $href;

	public function __construct($type, $params)
	{
		parent::__construct();
		$this->fromArray($params);
	}

	public function setRel($rel)
	{
		$this->rel = $rel;
		return $this;
	}

	public function getRel()
	{
		return $this->rel;
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
