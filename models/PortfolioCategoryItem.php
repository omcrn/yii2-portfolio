<?php

namespace omcrn\portfolio\models;

use Yii;

/**
 * This is the model class for table "{{%om_portfolio_category_item}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $item_id
 *
 * @property PortfolioItem $item
 * @property PortfolioCategory $category
 */
class PortfolioCategoryItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%om_portfolio_category_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'item_id'], 'required'],
            [['category_id', 'item_id'], 'integer'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PortfolioItem::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PortfolioCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('portfolio', 'ID'),
            'category_id' => Yii::t('portfolio', 'Category ID'),
            'item_id' => Yii::t('portfolio', 'Item ID'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PortfolioCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\query\PortfolioCategoryItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \omcrn\portfolio\models\query\PortfolioCategoryItemQuery(get_called_class());
    }
}
