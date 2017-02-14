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
    public $baseUrl = '@web';

    public $css = [
        'css/cropper.css',
        'css/file-input-cropper.css'
    ];

    public $js = [
        'js/cropper.js',
        'js/file-input-cropper.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

}