<?php
/**
 * OmlZf2ThemeManager - Module config file
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager;

return array(
    'view_helpers' => array(
        'invokables' => array(
            'omlZf2ThemeManager' => 'OmlZf2ThemeManager\View\Helper\ThemeInfo'
        )
    ),
    'oml-zf2-theme-manager' => array(
        'active_theme'  => 'npm-dashboard',
        'public_directory_path' => __DIR__.'/../../../../public',
        'themes' => array(
            'npm-dashboard' => array(
                'name' => 'NPM Dashboard',
                'template_path' => __DIR__.'/../templates/npm-dashboard/',
                'public_asset_path' => 'themes/npm-dashboard/assets/',
                'styles' => array(
                    'active_style' => 'orange',
                    'styles_asset_path' => 'themes/npm-dashboard/styles/',
                    'list' => array(
                        'orange' => array(
                            'style_name' => 'NPM Dashboard - Orange',
                            'load_assets' => array(
                                'css' => array(
                                    'orange/css/npm.dashboard.orange.css'
                                )
                            )
                        ),
                        'blue' => array(
                            'style_name' => 'NPM Dashboard - Blue',
                            'load_assets' => array(
                                'css' => array(
                                    'blue/css/npm.dashboard.blue.css'
                                )
                            )
                        ),
                        'green' => array(
                            'style_name' => 'NPM Dashboard - Green',
                            'load_assets' => array(
                                'css' => array(
                                    'green/css/npm.dashboard.green.css'
                                )
                            )
                        )
                    )
                )
            ),
            'bootstrap' => array(
                'name' => 'Default Bootstrap Theme for ZF2',
                'template_path' => __DIR__.'/../templates/bootstrap',
                'public_asset_path' => 'themes/bootstrap/',
                'styles' => false
            )
        )
    )
);
