<?php
/**
 * OmlZf2ThemeManager - Module Config Validator
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Validator;

use OmlZf2ThemeManager\Config\ModuleConfig;

class AssetValidator
{
    protected $moduleConfig;

    public function __construct(ModuleConfig $moduleConfig)
    {
        $this->moduleConfig = $moduleConfig;
    }

    public function isValid()
    {
        return $this->validate();
    }

    protected function validate()
    {
        return true;
    }
}

