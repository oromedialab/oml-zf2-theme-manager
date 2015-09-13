<?php
/**
 * OmlZf2ThemeManager - Theme Config File (NPM Dashboard)
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
return array(
    'template_map' => array(
        'layout/layout'        => __DIR__ . '/layout/layout.phtml',
        'layout/minimal-light' => __DIR__ . '/layout/minimal-light.phtml',
        'layout/minimal-dark'  => __DIR__ . '/layout/minimal-dark.phtml',
        'error/404'     => __DIR__ . '/error/404.phtml',
        'error/index'   => __DIR__ . '/error/index.phtml',
    ),
    'template_path_stack' => array(
        'npm-dashboard'   => __DIR__
    ),
    'public_asset_path' => 'themes/npm-dashboard/',
    'active_style'      => 'orange',
    'style_collection'  => array(
        array(
            'name'       => 'NPM Dashboard - Orange',
            'identifier' => 'orange',
            'layout'     => 'layout/layout',
            'assets_ref' => array('@1', '@2', '@3', '@5')
        ),
        array(
            'name'       => 'NPM Dashboard - Blue',
            'identifier' => 'blue',
            'layout'     => 'layout/layout',
            'assets_ref' => array('@1', '@2', '@4', '@5')
        ),
        array(
            'name'       => 'NPM Dashboard - Minimal Light',
            'identifier' => 'minimal-light',
            'layout'     => 'layout/minimal-light',
            'assets_ref' => array('@1', '@2', '@3', '@5')
        ),
        array(
            'name'       => 'NPM Dashboard - Minimal Dark',
            'identifier' => 'minimal-dark',
            'layout'     => 'layout/minimal-dark',
            'assets_ref' => array('@1', '@2', '@3', '@5')
        ),
    ),
    'asset_collection' => array(
        '@1' => array(
            'favicon' => array(
                array(
                    'rel' => 'shortcut icon',
                    'href' => 'images/favicon.ico'
                ),
                array(
                    'rel' => 'apple-touch-icon',
                    'href' => 'images/apple-touch-icon.png'
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
                    'href' => 'css/npm.dashboard.orange.css'
                )
            )
        ),
        '@4' => array(
            'css' => array(
                array(
                    'href' => 'css/npm.dashboard.blue.css'
                )
            )
        ),
        '@5' => array(
            'css' => array(
                array(
                    'href' => 'css/bootstrap.css',
                ),
                array(
                    'href' => 'css/font-awesome.min.css'
                ),
                array(
                    'href' => 'css/jquery-ui.css'
                ),
                array(
                    'href' => 'css/animate.css'
                ),
                array(
                    'href' => 'css/datatable.css'
                ),
                array(
                    'href' => 'css/select2.css'
                ),
                array(
                    'href' => 'css/jquery.fancybox-1.3.4.css'
                ),
                array(
                    'href' => 'css/ladda.min.css'
                ),
                array(
                    'href' => 'css/style.css'
                )
            ),
            'js' => array(
                array(
                    'href' => 'js/jquery.js',
                ),
                array(
                    'href' => 'js/jquery-migrate-1.2.1.js',
                ),
                array(
                    'href' => 'js/bootstrap.min.js',
                ),
                array(
                    'href' => 'js/jquery.uniform.js',
                ),
                array(
                    'href' => 'js/footable.js',
                ),
                array(
                    'href' => 'js/jquery.dataTables.min.js',
                ),
                array(
                    'href' => 'js/jquery.validate.js',
                ),
                array(
                    'href' => 'js/select2.js',
                ),
                array(
                    'href' => 'js/jquery.fakecrop.js',
                ),
                array(
                    'href' => 'js/jquery.fancybox-1.3.4.pack.js',
                ),
                array(
                    'href' => 'js/jquery.flot.js',
                ),
                array(
                    'href' => 'js/jquery.flot.tooltip.min.js',
                ),
                array(
                    'href' => 'js/jquery.flot.resize.js',
                ),
                array(
                    'href' => 'js/jquery.flot.pie.resize.js',
                ),
                array(
                    'href' => 'js/jquery.flot.animator.min.js',
                ),
                array(
                    'href' => 'js/jquery.flot.growraf.js',
                ),
                array(
                    'href' => 'js/jquery.flot.fillbetween.min.js',
                ),
                array(
                    'href' => 'js/jquery.flot.stack.js',
                ),
                array(
                    'href' => 'js/jquery.flot.spline.min.js',
                ),
                array(
                    'href' => 'js/jquery.flot.selection.js',
                ),
                array(
                    'href' => 'js/jquery.flot.time.js',
                ),
                array(
                    'href' => 'js/custom.datatable.js',
                ),
                array(
                    'href' => 'js/jquery-ui.js',
                ),
                array(
                    'href' => 'js/spin.min.js',
                ),
                array(
                    'href' => 'js/ladda.min.js',
                ),
                array(
                    'href' => 'js/classie.js',
                ),
                array(
                    'href' => 'js/script.js',
                ),
                array(
                    'href' => 'js/custom.js',
                ),
                array(
                    'href' => 'js/custom.ajax.js'
                )
            )
        )
    )
);
