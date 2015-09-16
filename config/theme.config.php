<?php
/**
 * OmlZf2ThemeManager - Theme config file
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
return array(
	'oml-zf2-theme-manager' => array(
        'active_theme'  => 'npm-dashboard',
        'themes' => array(
            array(
                'name' => 'NPM Dashboard',
                'identifier' => 'npm-dashboard',
                'theme_path' => __DIR__.'/../themes/npm-dashboard',
            ),
            array(
                'name' => 'Default Bootstrap Theme for ZF2',
                'identifier' => 'bootstrap',
                'theme_path' => __DIR__.'/../themes/bootstrap',
            )
        ),
        'style_switcher' => array(
            'routes' => array(
                'hoame' => array(
                    'theme' => 'npm-dashboard',
                    'style' => 'blue'
                ),
                'hoame' => array(
                    'theme' => 'bootstrap',
                    'style' => 'default'
                )
            )
        )
    )
);
