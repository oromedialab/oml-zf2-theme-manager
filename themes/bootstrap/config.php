<?php
/**
 * OmlZf2ThemeManager - Theme Config File (Bootstrap)
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
    'active_style'      => 'default',
    'style_collection'  => array(
        array(
            'name'       => 'Default Bootstrap Theme for Zend Framework 2',
            'identifier' => 'default',
            'layout'     => 'layout/layout',
            'assets_ref' => array('@1', '@2', '@3')
        )
    ),
    'asset_collection' => array(
        '@1' => array(
            'favicon' => array(
                array(
                    'rel' => 'shortcut icon',
                    'href' => 'img/favicon.ico'
                ),
                array(
                    'rel' => 'apple-touch-icon',
                    'href' => 'img/apple-touch-icon.png'
                )
            )
        ),
        '@2' => array(
            'logo' => array(
                array(
                    'dimension' => '256X256',
                    'href' => 'images/logo.png'
                )
            )
        ),
        '@3' => array(
            'css' => array(
                array(
                    'href' => 'css/style.css'
                ),
                array(
                    'href' => 'css/bootstrap-theme.min.css'
                ),
                array(
                    'href' => 'css/bootstrap.min.css'
                )
            ),
            'js' => array(
                array(
                    'href' => 'js/bootstrap.min.js'
                ),
                array(
                    'href' => 'js/jquery.min.js'
                ),
                array(
                    'href' => 'js/respond.min.js',
                    'params' => array(
                        'text/javascript',
                        array('conditional' => 'lt IE 9',)
                    )
                ),
                array(
                    'href' => 'js/html5shiv.min.js',
                    'params' => array(
                        'text/javascript',
                        array('conditional' => 'lt IE 9',)
                    )
                )
            )
        )
    )
);
