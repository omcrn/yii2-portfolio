<?php
/**
 * User: zura
 * Date: 2/15/17
 * Time: 11:49 AM
 */

namespace omcrn\portfolio\widgets;

use omcrn\portfolio\AssetBundle;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;


/**
 * Class CropperInputWidth
 *
 * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package omcrn\portfolio\widgets
 */
class CropperInputWidget extends InputWidget
{
    /**
     * @var array
     * Full list of available client options see here:
     * @link https://github.com/fengyuanchen/cropper#options
     */
    public $clientOptions = [];
    /**
     * @var array
     */
    public $containerOptions = [];
    /**
     * @var array
     */
    public $cropperOptions = [];

    public function init()
    {
        parent::init();
        // Init default clientOptions
        $this->clientOptions = ArrayHelper::merge([
            'cropperOptions' => $this->cropperOptions
        ], $this->clientOptions);

        // Init default options
        $this->options = ArrayHelper::merge([
            'class' => 'form-control',
        ], $this->options);

        if (!isset($this->containerOptions['id'])) {
            $this->containerOptions['id'] = $this->getId();
        }

        $this->registerJs();
    }

    protected function registerJs()
    {
        AssetBundle::register($this->getView());
        $clientOptions = Json::encode($this->clientOptions);
         $this->getView()->registerJs("$('#{$this->containerOptions['id']}').find('input[type=file]').omFileInput({$clientOptions})");
    }

    /**
     * @return string
     */
    public function run()
    {
        $content = [];
        $content[] = Html::beginTag('div', $this->containerOptions);
        $content[] = $this->renderInput();

        $content[] = Html::endTag('div');
        return implode("\n", $content);
    }

    /**
     * @return string
     */
    protected function renderInput()
    {
        if ($this->hasModel()) {
            $content = Html::activeFileInput($this->model, $this->attribute, $this->options);
        } else {
            $content = Html::fileInput($this->name, $this->value, $this->options);
        }
        return $content;
    }

}