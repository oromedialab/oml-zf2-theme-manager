<?php
/**
 * OmlZf2ThemeManager - Theme Asset Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Theme\Asset;

class Asset
{
	protected $identifier;

	protected $type;

	protected $options;

	protected static $classMapper = array(
		'favicon' => '\OmlZf2ThemeManager\Theme\Asset\Favicon',
		'logo' => '\OmlZf2ThemeManager\Theme\Asset\Logo',
		'css' => '\OmlZf2ThemeManager\Theme\Asset\Css',
		'js' => '\OmlZf2ThemeManager\Theme\Asset\Js'
	);

	protected function __construct() { }

	public static function init($identifier, $type, $options)
	{
		if (!array_key_exists($type, self::$classMapper)) {
			throw new \Exception('Asset for type "'.$type.'" does not exist');
		}
		$className = self::$classMapper[$type];
		$class = new $className($type, $options);
		$class->setIdentifier($identifier);
		$class->setType($type);
		$class->setOptions($options);
		return $class;
	}

	public function setIdentifier($identifier)
	{
		$this->identifier = $identifier;
		return $this;
	}

	public function getIdentifier()
	{
		return $this->identifier;
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

	public function setOptions($options)
	{
		$this->options = $options;
		return $this;
	}

	public function getOptions()
	{
		return $this->options;
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
}
