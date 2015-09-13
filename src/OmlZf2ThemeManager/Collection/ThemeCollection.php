<?php
/**
 * OmlZf2ThemeManager - Theme Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Collection;

use OmlZf2ThemeManager\Collection\ArrayCollection;
use OmlZf2ThemeManager\Theme\Theme;

class ThemeCollection extends ArrayCollection
{
    public function add(Theme $theme)
    {
        $this->collections[] = $theme;
        return $this;
    }
}
