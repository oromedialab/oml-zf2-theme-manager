<?php
/**
 * OmlZf2ThemeManager - Theme Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager;

use OmlZf2ThemeManager\ThemeHydrator;

class ThemeCollection
{
    protected $themeHydrators = array();

    public function setThemeHydrator(ThemeHydrator $themeHydrator)
    {
        $this->themeHydrator[] = $themeHydrator;
        return $this;
    }

    public function fetchAll()
    {
        return $this->themeHydrators;
    }
}
