<?php

namespace omcrn\portfolio;
use yii\helpers\Url;

/**
 * portfolio module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    /**
     * @var string
     */
    public $controllerNamespace = 'omcrn\portfolio\controllers';

    /**
     * @inheritdoc
     */
    /**
     * @var null|string
     */
    public $mediaUrlPrefix = null;

    /**
     * @var string
     */
    public $mediaUrlReplacement = '{{media_item_url_prefix}}';

    /**
     * Module constructor.
     * @param string $id
     * @param null $parent
     * @param array $config
     */
    public function __construct($id, $parent = null, $config = [])
    {
        parent::__construct($id, $parent, $config);
        if (!$this->mediaUrlPrefix){
            $this->mediaUrlPrefix = Url::base(true);
        }

    }
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
