<?php
/**
 * OmlZf2ThemeManager - Style Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Collection;

use OmlZf2ThemeManager\Style;

class StyleCollection
{
    protected $styles = array();

    public function add(Style $style)
    {
        $this->styles[] = $style;
        return $this;
    }

    public function fetchAll()
    {
        return $this->styles;
    }
}
