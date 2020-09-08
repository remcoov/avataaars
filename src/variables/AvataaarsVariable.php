<?php
/**
 * Avataaars plugin for Craft CMS 3.x
 *
 * With Avataaars you can create avatar icons by combining clothes, hair, emotions, accessories, and colors.
 *
 * @link      https://github.com/remcoov
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\avataaars\variables;

use remcoov\avataaars\Avataaars;

use Craft;

/**
 * Avataaars Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.avataaars }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    remcoov
 * @package   Avataaars
 * @since     1.0.0
 */
class AvataaarsVariable
{
    public function avataaar(array $options = [] ) : string {
        return Avataaars::$plugin->avataaarsService->avataaar($options);
    }

    public function userPhotoForm(array $options = [] ) : string {
        return Avataaars::$plugin->avataaarsService->userPhotoForm($options);
    }
}
