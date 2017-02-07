<?php
/**
 * Created by PhpStorm.
 * User: berdia
 * Date: 2/7/17
 * Time: 4:13 PM
 */

namespace omcrn\portfolio\web;

use omcrn\portfolio\AssetBundle;

class Controller extends \yii\web\Controller
{
    public function init()
    {
        parent::init();
        AssetBundle::register($this->getView());
    }

    public function beforeAction($action)
    {
        if (isset(\Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapPluginAsset'])) {
            \Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapPluginAsset']->depends[] = 'yii\jui\JuiAsset';
        }
        return parent::beforeAction($action);
    }
}