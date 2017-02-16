<?php
/**
 * User: zura
 * Date: 2/14/17
 * Time: 12:56 PM
 */

namespace omcrn\portfolio;

use yii\web\AssetBundle;


/**
 * Class CropperAssetBundle
 *
 * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package vendor\omcrn\portfolio
 */
class CropperAssetBundle extends AssetBundle
{
    public $sourcePath = '@bower/cropper/dist';
    public $css = [
        'cropper.css',
    ];

    public $js = [
        'cropper.js'
    ];
}