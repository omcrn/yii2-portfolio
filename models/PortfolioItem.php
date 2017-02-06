<?php

namespace omcrn\portfolio\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%om_portfolio_item}}".
 *
 * @property integer $id
 * @property string $thumbnail
 * @property string $slug
 * @property string $start_date
 * @property string $end_date
 * @property integer $sort_order
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property PortfolioCategoryItem[] $omPortfolioCategoryItems
 * @property PortfolioItemAttachment[] $omPortfolioItemAttachments
 * @property PortfolioItemTranslation[] $omPortfolioItemTranslations
 */
class PortfolioItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%om_portfolio_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thumbnail', 'slug'], 'required'],
            [['slug'],'string'],
            [['slug'],'unique'],
            [['start_date', 'end_date'], 'safe'],
            [['sort_order', 'created_at', 'updated_at'], 'integer'],
            [['thumbnail'], 'string', 'max' => 255],
        ];
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'immutable' => true
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('portfolio', 'ID'),
            'slug' => Yii::t('portfolio', 'Slug'),
            'thumbnail' => Yii::t('portfolio', 'Thumbnail'),
            'start_date' => Yii::t('portfolio', 'Start Date'),
            'end_date' => Yii::t('portfolio', 'End Date'),
            'sort_order' => Yii::t('portfolio', 'Sort Order'),
            'created_at' => Yii::t('portfolio', 'Created At'),
            'updated_at' => Yii::t('portfolio', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioCategoryItems()
    {
        return $this->hasMany(PortfolioCategoryItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioItemAttachments()
    {
        return $this->hasMany(PortfolioItemAttachment::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioItemTranslations()
    {
        return $this->hasMany(PortfolioItemTranslation::className(), ['item_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\query\PortfolioItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \omcrn\portfolio\models\query\PortfolioItemQuery(get_called_class());
    }
}
