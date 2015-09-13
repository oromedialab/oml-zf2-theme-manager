<?php
/**
 * OmlZf2ThemeManager - Asset Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Collection;

use OmlZf2ThemeManager\Collection\ArrayCollection;
use OmlZf2ThemeManager\Theme\Asset\AssetInterface;

class AssetCollection extends ArrayCollection
{
    public function add(AssetInterface $asset)
    {
        $this->collections[] = $asset;
        return $this;
    }
}
