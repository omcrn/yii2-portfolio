<?php

namespace omcrn\portfolio\models;

use omcrn\portfolio\helpers\Html;
use Yii;

/**
 * This is the model class for table "{{%om_portfolio_item_translation}}".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $locale
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $keywords
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * @property PortfolioItem $item
 */
class PortfolioItemTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%om_portfolio_item_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'locale', 'title', 'short_description'], 'required'],
            [['item_id'], 'integer'],
            [['description'], 'string'],
            [['locale'], 'string', 'max' => 10],
            [['title', 'keywords'], 'string', 'max' => 255],
            [['short_description', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 512],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PortfolioItem::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('portfolio', 'ID'),
            'item_id' => Yii::t('portfolio', 'Item ID'),
            'locale' => Yii::t('portfolio', 'Locale'),
            'title' => Yii::t('portfolio', 'Title'),
            'short_description' => Yii::t('portfolio', 'Short Description'),
            'description' => Yii::t('portfolio', 'Description'),
            'keywords' => Yii::t('portfolio', 'Keywords'),
            'meta_title' => Yii::t('portfolio', 'Meta Title'),
            'meta_description' => Yii::t('portfolio', 'Meta Description'),
            'meta_keywords' => Yii::t('portfolio', 'Meta Keywords'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(PortfolioItem::className(), ['id' => 'item_id']);
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\query\PortfolioItemTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \omcrn\portfolio\models\query\PortfolioItemTranslationQuery(get_called_class());
    }

    public function getBody()
    {
        return Html::decodeMediaItemUrls($this->description);
    }

    public function getShortDescription()
    {
        return Html::decodeMediaItemUrls($this->short_description);
    }
}
