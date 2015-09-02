<?php
/**
 * OmlZf2ThemeManager - Local theme config file
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
return array(
    'template_map' => array(
        'layout/layout' => __DIR__ . '/layout/layout.phtml',
        'error/404'     => __DIR__ . '/error/404.phtml',
        'error/index'   => __DIR__ . '/error/index.phtml',
    ),
    'template_path_stack' => array(
        'bootstrap-default-zf2' => __DIR__ . '/themes/bootstrap-default-zf2',
    )
);
