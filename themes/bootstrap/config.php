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
        'bootstrap' => __DIR__
    ),
    'public_asset_path' => 'themes/bootstrap/',
    'assets' => array(
        'favicon' => array(
            'shortcut icon' => 'images/favicon.ico',
            'apple-touch-icon' => 'apple-touch-icon.png'
        ),
    	'css' => array(
    		'css/style.css',
    		'css/bootstrap-theme.min.css',
			'css/bootstrap.min.css'
    	),
    	'js' => array(
    		'js/bootstrap.min.js',
            'js/jquery.min.js',
            array(
            	'resource' => 'js/respond.min.js',
                'args' => array(
                    'text/javascript',
                    array('conditional' => 'lt IE 9',)
                )
            ),
            array(
            	'resource' => 'js/html5shiv.min.js',
                'args' => array(
                    'text/javascript',
                    array('conditional' => 'lt IE 9',)
                )
            )
    	)
    )
);
