<?php
/**
 * Created by PhpStorm.
 * User: berdia
 * Date: 2/7/17
 * Time: 4:10 PM
 */

namespace omcrn\portfolio;


class AssetBundle extends \yii\web\AssetBundle
{
//    public $sourcePath = '@vendor/omcrn/yii2-portfolio/assets';

    public $css = [
//        'css/cropper.css',
        'css/portfolio.css'
    ];

    public $js = [
//        'js/cropper.js',
        'js/portfolio.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'omcrn\portfolio\CropperAssetBundle'
    ];
//
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

}