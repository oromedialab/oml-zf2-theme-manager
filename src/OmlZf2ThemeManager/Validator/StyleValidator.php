<?php
/**
 * OmlZf2ThemeManager - Style Validator class
 *
 * @author Ibrahim Azhar Armar <azhar@iarmar.com>
 * @version 0.1
 * @package OmlZf2
 */
namespace OmlZf2ThemeManager\Validator;

use OmlZf2ThemeManager\Core\Utility;

class StyleValidator
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function validate()
    {
        $config = $this->getConfig();

        echo '<pre>';
        print_r($config);
        die;

        $styleCollection = array_key_exists('style_collection', $config) ? $config['style_collection'] : array();
        $defaultStyleIdentifier = array_key_exists('default_style', $config) ? $config['default_style'] : null;
        $defaultStyleIdentifierIsAvailableInCollection = false;
        $publicAssetPath = Utility::PUBLIC_DIRECTORY_PATH().$config['public_asset_path'];

        if (!array_key_exists('default_style', $config) || empty($config['default_style'])) {
            throw new \Exception('Invalid or non-existent default style');
        }
        if (!file_exists($publicAssetPath) || !is_dir($publicAssetPath)) {
            throw new \Exception('Directory does not exist at given path for public_asset_path');
        }
        if (!array_key_exists('style_collection', $config) || empty($config['style_collection'])) {
            throw new \Exception('Invalid or empty style collection');
        }

        foreach ($styleCollection as $styleConfig) {

            if (!array_key_exists('name', $styleConfig) || empty($styleConfig['name'])) {
                throw new \Exception('Style name does not exist in collection');
            }
            if (!array_key_exists('identifier', $styleConfig) || empty($styleConfig['identifier'])) {
                throw new \Exception('Style identifier does not exist in collection');
            }
            if (!array_key_exists('layout', $styleConfig) || empty($styleConfig['layout'])) {
                throw new \Exception('Style layout does not exist in collection');
            }
            if (!array_key_exists('logo_ref', $styleConfig) || empty($styleConfig['logo_ref'])) {
                throw new \Exception('Style logo does not exist in collection');
            }

            $logo = Utility::PUBLIC_DIRECTORY_PATH().$styleConfig['style_asset_path'].$styleConfig['logo'];

            if (!file_exists($logo)) {
                throw new \Exception('Logo does not exist at given path for style '.$styleConfig['identifier']);
            }

            if (!array_key_exists('assets_ref', $styleConfig) || empty($styleConfig['assets_ref']) || !is_array($styleConfig['assets_ref'])) {
                throw new \Exception('Invalid assets params or assets missing from style collection');
            }

            // Check if active style has a matching identifier in collection
            if ($activeStyleIdentifier === $styleConfig['identifier']) {
                $activeStyleIdentifierIsAvailableInCollection = true;
            }
        }

        if (false === $activeStyleIdentifierIsAvailableInCollection) {
            throw new \Exception('Active style "'. $activeStyleIdentifier .'" is not not available in collection');
        }

        return true;
    }

    public function isValid()
    {
        return $this->validate();
    }

    protected function getConfig()
    {
        return $this->config;
    }
}
