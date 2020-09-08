<?php
/**
 * Avataaars plugin for Craft CMS 3.x
 *
 * With Avataaars you can create avatar icons by combining clothes, hair, emotions, accessories, and colors.
 *
 * @link      https://github.com/remcoov
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\avataaars\services;

use remcoov\avataaars\Avataaars;

use Craft;
use craft\base\Component;
use craft\web\View; // FOR SETTING USERPIC
use craft\elements\Asset; // FOR SETTING USERPIC
use craft\helpers\Assets; // FOR SETTING USERPIC
use craft\errors\VolumeException; // FOR SETTING USERPIC

/**
 * AvataaarsService Service
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    remcoov
 * @package   Avataaars
 * @since     1.0.0
 */
class AvataaarsService extends Component
{
    // Public Methods
    // =========================================================================

    public function avataaar(array $options = []) : string {
        
        $defaultOptions = [
            'seed' => substr(md5(rand()),0,8),
            'radius' => 0, // max 50
            'width' => NULL,
            'height' => NULL,
            'margin' => 0, // max 25
            'background' => NULL,
            'style' => 'transparent', // transparent, circle
            'top' => NULL, // longHair, shortHair, eyepatch, hat, hijab, turban
            'hatColor' => NULL, // black, blue, gray, heather, pastel, pink, red, white
            'hairColor' => NULL, // auburn, black, blonde, brown, pastel, platinum, red, gray
            'accessories' => NULL, // kurt, prescription01, prescription02, round, sunglasses, wayfarers
            'facialHair' => NULL, // medium, light, majestic, fancy, magnum
            'facialHairColor' => NULL, // auburn, black, blonde, brown, platinum, red
            'clothes' => NULL, // blazer, sweater, shirt, hoodie, overall
            'clothesColor' => NULL, // black, blue, gray, heather, pastel, pink, red, white
            'eyes' => NULL, // close, cry, default, dizzy, roll, happy, hearts, side, squint, surprised, wink, winkWacky
            'eyebrow' => NULL, // angry, default, flat, raised, sad, unibrow, up
            'mouth' => NULL, // concerned, default, disbelief, eating, grimace, sad, scream, serious, smile, tongue, twinkle, vomit
            'skin' => NULL, // tanned, yellow, pale, light, brown, darkBrown, black
            'svg' => FALSE // TRUE OR FALSE
        ];

        $finalOptions = array_merge($defaultOptions, $options);

        $url = rtrim('https://avatars.dicebear.com/api/avataaars/'.$finalOptions['seed'].'.svg?'
            .( $finalOptions['radius'] ? 'radius='.$finalOptions['radius'].'&' : NULL )
            .( $finalOptions['width'] ? 'width='.$finalOptions['width'].'&' : NULL )
            .( $finalOptions['height'] ? 'height='.$finalOptions['height'].'&' : NULL )
            .( $finalOptions['margin'] ? 'margin='.$finalOptions['margin'].'&' : NULL )
            .( $finalOptions['background'] ? 'background=%23'.$finalOptions['background'].'&' : NULL )
            .( $finalOptions['style'] ? 'style='.$finalOptions['style'].'&' : NULL )
            .( $finalOptions['top'] ? 'top[]='.$finalOptions['top'].'&' : NULL )
            .( $finalOptions['hatColor'] ? 'hatColor[]='.$finalOptions['hatColor'].'&' : NULL )
            .( $finalOptions['hairColor'] ? 'hairColor[]='.$finalOptions['hairColor'].'&' : NULL )
            .( $finalOptions['accessories'] ? 'accessories[]='.$finalOptions['accessories'].'&accessoriesChance=100&' : NULL )
            .( $finalOptions['facialHair'] ? 'facialHair[]='.$finalOptions['facialHair'].'&facialHairChance=100&' : NULL )
            .( $finalOptions['facialHairColor'] ? 'facialHairColor[]='.$finalOptions['facialHairColor'].'&' : NULL )
            .( $finalOptions['clothes'] ? 'clothes[]='.$finalOptions['clothes'].'&' : NULL )
            .( $finalOptions['clothesColor'] ? 'clothesColor[]='.$finalOptions['clothesColor'].'&' : NULL )
            .( $finalOptions['eyes'] ? 'eyes[]='.$finalOptions['eyes'].'&' : NULL )
            .( $finalOptions['eyebrow'] ? 'eyebrow[]='.$finalOptions['eyebrow'].'&' : NULL )
            .( $finalOptions['mouth'] ? 'mouth[]='.$finalOptions['mouth'].'&' : NULL )
            .( $finalOptions['skin'] ? 'skin[]='.$finalOptions['skin'].'&' : NULL )
        ,'&');

        if( $finalOptions['svg'] ) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
            ));
            $svg = curl_exec($curl);
            curl_close($curl);

            return $svg;
        } else {
            return $url;
        }

    }

    public function userPhotoForm(array $options = []) : string {

        $volumes = Craft::$app->getVolumes();
        $volumeUid = Craft::$app->getProjectConfig()->get('users.photoVolumeUid');

        if (!$volumeUid || ($volume = $volumes->getVolumeByUid($volumeUid)) === null) {
            throw new VolumeException(Craft::t('app',
                'The volume set for user photo storage is not valid.'));
        }
        
        $oldMode = Craft::$app->view->getTemplateMode();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $showUserPhotoForm = Craft::$app->view->renderTemplate('avataaars/userPhotoForm');
        Craft::$app->view->setTemplateMode($oldMode);
        return $showUserPhotoForm;
        
    }

    public function setUserPhoto(string $svgCode) : bool {

        $users = Craft::$app->getUsers();
        $userId = Craft::$app->getUser()->id;
        $user = Craft::$app->users->getUserById($userId);

        $filename = Assets::prepareAssetName('avataaar.svg');
        $tempPath = Assets::tempFilePath($filename);
        file_put_contents($tempPath, $svgCode);
        $users->saveUserPhoto($tempPath, $user, $filename);

        return true;
    }

}
