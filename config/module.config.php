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
    'oml-zf2-theme' => array(
        'active'  => 'npm-dashboard-default',
        'themes' => array(
            'npm-dashboard-default' => array(
                'name' => 'NPM Dashboard - Default',
                'template_path' => __DIR__.'/../themes/npm-dashboard-default',
                'public_asset_path' => __DIR__.'/../../../../public/themes/npm-dashboard-default'
            ),
            'npm-dashboard-blue' => array(
                'name' => 'NPM Dashboard - Blue',
                'template_path' => __DIR__.'/../themes/npm-dashboard-blue',
                'public_asset_path' => __DIR__.'/../../../../public/themes/npm-dashboard-blue'
            ),
            'npm-dashboard-green' => array(
                'name' => 'NPM Dashboard - Green',
                'template_path' => __DIR__.'/../themes/npm-dashboard-green',
                'public_asset_path' => __DIR__.'/../../../../public/themes/npm-dashboard-green'
            ),
            'bootstrap-default-zf2' => array(
                'name' => 'Default Bootstrap Theme for ZF2',
                'template_path' => __DIR__.'/../themes/bootstrap-default-zf2',
                'public_asset_path' => __DIR__.'/../../../../public/themes/bootstrap-default-zf2'
            )
        )
    )
);
