<?php
/**
 * Avataaars plugin for Craft CMS 3.x
 *
 * With Avataaars you can create avatar icons by combining clothes, hair, emotions, accessories, and colors.
 *
 * @link      https://github.com/remcoov
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\avataaars\controllers;

use remcoov\avataaars\Avataaars;

use Craft;
use craft\web\Controller;

/**
 * Avataaars Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    remcoov
 * @package   Avataaars
 * @since     1.0.0
 */
class UserPhotoController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = [];

    // Public Methods
    // =========================================================================

    public function actionGetImagePreview()
    {
        $options = $_POST;
        unset($options['CRAFT_CSRF_TOKEN']);

        return Avataaars::$plugin->avataaarsService->avataaar($options);
    }

    public function actionSetUserPhoto()
    {
        $options = $_POST;
        unset($options['CRAFT_CSRF_TOKEN']);

        $svgCode = Avataaars::$plugin->avataaarsService->avataaar($options);
        return Avataaars::$plugin->avataaarsService->setUserPhoto($svgCode);
    }

}
