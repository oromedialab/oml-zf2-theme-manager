<?php

namespace OmlZf2ThemeManager;

class Asset
{
	protected $type;

	protected $resource;

	public function __construct($type, $resource)
	{
		$this->type = $type;
		$this->resource = $resource;
	}

	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setResource()
	{
		$this->resource = $resource;
		return $this;
	}

	public function getResource()
	{
		return $this->resource;
	}

	/**
     * Properties to Array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
