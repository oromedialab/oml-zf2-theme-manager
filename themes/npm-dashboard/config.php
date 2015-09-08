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
        'npm-dashboard' => __DIR__
    ),
    'public_asset_path' => 'themes/npm-dashboard/assets/',
    'style' => array(
        'active' => 'blue',
        'style_asset_path' => 'themes/npm-dashboard/styles/',
        'collection' => array(
            array(
                'name' => 'NPM Dashboard - Orange',
                'identifier' => 'orange',
                'load_assets' => array(
                    'css' => array(
                        'orange/css/npm.dashboard.orange.css'
                    )
                )
            ),
            array(
                'name' => 'NPM Dashboard - Blue',
                'identifier' => 'blue',
                'load_assets' => array(
                    'css' => array(
                        'orange/css/npm.dashboard.blue.css'
                    )
                )
            ),
            array(
                'name' => 'NPM Dashboard - Green',
                'identifier' => 'green',
                'load_assets' => array(
                    'css' => array(
                        'orange/css/npm.dashboard.green.css'
                    )
                )
            )
        )
    ),
    'assets' => array(
    	'css' => array(
    		'css/bootstrap.css',
    		'css/font-awesome.min.css',
    		'css/jquery-ui.css',
    		'css/animate.css',
    		'css/datatable.css',
    		'css/select2.css',
    		'css/jquery.fancybox-1.3.4.css',
    		'css/ladda.min.css',
    		'css/style.css'
    	),
    	'js' => array(
    		'js/jquery.js',
            'js/jquery-migrate-1.2.1.js',
            'js/bootstrap.min.js',
            'js/jquery.uniform.js',
            'js/footable.js',
            'js/jquery.dataTables.min.js',
            'js/jquery.validate.js',
            'js/select2.js',
            'js/jquery.fakecrop.js',
            'js/jquery.fancybox-1.3.4.pack.js',
            'js/jquery.flot.js',
            'js/jquery.flot.tooltip.min.js',
            'js/jquery.flot.resize.js',
            'js/jquery.flot.pie.resize.js',
            'js/jquery.flot.animator.min.js',
            'js/jquery.flot.growraf.js',
            'js/jquery.flot.fillbetween.min.js',
            'js/jquery.flot.stack.js',
            'js/jquery.flot.spline.min.js',
            'js/jquery.flot.selection.js',
            'js/jquery.flot.time.js',
            'js/custom.datatable.js',
            'js/jquery-ui.js',
            'js/spin.min.js',
            'js/ladda.min.js',
            'js/classie.js',
            'js/script.js',
            'js/custom.js',
            'js/custom.ajax.js'
    	)
    )
);
