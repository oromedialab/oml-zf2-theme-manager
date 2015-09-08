<?php
/**
 * OmlZf2ThemeManager - Theme Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Collection;

use OmlZf2ThemeManager\Theme;

class ThemeCollection
{
    protected $themes = array();

    public function add(Theme $theme)
    {
        $this->themes[] = $theme;
        return $this;
    }

    public function fetchAll()
    {
        return $this->themes;
    }
}
