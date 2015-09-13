<?php
/**
 * OmlZf2ThemeManager - Array Collection Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Collection;

class ArrayCollection implements \Countable, \IteratorAggregate
{
    protected $collections = array();

    public function count()
    {
        return count($this->collections);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collections);
    }
}
