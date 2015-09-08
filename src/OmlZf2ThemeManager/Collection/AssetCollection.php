<?php
/**
 * OmlZf2ThemeManager - Asset Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Collection;

use OmlZf2ThemeManager\Asset;

class AssetCollection
{
    protected $assets = array();

    public function add(Asset $asset)
    {
        $this->assets[] = $asset;
        return $this;
    }

    public function fetchAll()
    {
        return $this->assets;
    }
}
