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
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            'omlZF2TM' => 'OmlZf2ThemeManager\View\Helper\OmlZf2ThemeManager'
        )
    )
);
