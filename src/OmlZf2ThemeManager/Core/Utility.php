<?php
/**
 * OmlZf2ThemeManager - Utility Class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Core;

use Zend\ServiceManager\ServiceManager;

class Utility
{
	public static function PUBLIC_DIRECTORY_PATH()
	{
		return __DIR__.'/../../../../../../public/';
	}

	public static function getParams(ServiceManager $sm)
    {
        $router = $sm->get('router');
        $request = $sm->get('request');
        $matchedRoute = $router->match($request);
        $params = $matchedRoute->getParams();
        $params['matched_route_name'] = $matchedRoute->getMatchedRouteName();
        return $params;
    }
}
