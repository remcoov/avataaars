<?php
/**
 * Avataaars plugin for Craft CMS 3.x
 *
 * With Avataaars you can create avatar icons by combining clothes, hair, emotions, accessories, and colors.
 *
 * @link      https://github.com/remcoov
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\avataaars\assetbundles\avataaars;

use Craft;
use craft\web\AssetBundle;

/**
 * AvataaarsAsset AssetBundle
 *
 * AssetBundle represents a collection of asset files, such as CSS, JS, images.
 *
 * Each asset bundle has a unique name that globally identifies it among all asset bundles used in an application.
 * The name is the [fully qualified class name](http://php.net/manual/en/language.namespaces.rules.php)
 * of the class representing it.
 *
 * An asset bundle can depend on other asset bundles. When registering an asset bundle
 * with a view, all its dependent asset bundles will be automatically registered.
 *
 * http://www.yiiframework.com/doc-2.0/guide-structure-assets.html
 *
 * @author    remcoov
 * @package   Avataaars
 * @since     1.0.0
 */
class AvataaarsAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * Initializes the bundle.
     */
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = "@remcoov/avataaars/assetbundles/avataaars/dist";

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'js/Avataaars.js',
        ];

        $this->css = [
            'css/Avataaars.css',
        ];

        parent::init();
    }
}
