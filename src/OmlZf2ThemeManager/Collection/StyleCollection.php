<?php
/**
 * OmlZf2ThemeManager - Style Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Collection;

use OmlZf2ThemeManager\Collection\ArrayCollection;
use OmlZf2ThemeManager\Theme\Style\Style;

class StyleCollection extends ArrayCollection
{
    public function add(Style $style)
    {
        $this->collections[] = $style;
        return $this;
    }
}
