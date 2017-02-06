<?php

namespace omcrn\portfolio\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%om_portfolio_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property PortfolioCategoryItem[] $PortfolioCategoryItems
 */
class PortfolioCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%om_portfolio_category}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['slug'],'string'],
            [['slug'],'unique'],
        ];
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'immutable' => true
            ]
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('portfolio', 'ID'),
            'name' => Yii::t('portfolio', 'Name'),
            'slug' => Yii::t('portfolio', 'Slug'),
            'status' => Yii::t('portfolio', 'Status'),
            'created_at' => Yii::t('portfolio', 'Created At'),
            'updated_at' => Yii::t('portfolio', 'Updated At'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioCategoryItems()
    {
        return $this->hasMany(PortfolioCategoryItem::className(), ['category_id' => 'id']);
    }


    public static function getCategories()
    {
        $return = [];
        $categories = self::find() ->all();
        foreach ($categories as $cat){
            $return[$cat['id']] = $cat['name'];
        }
        return $return;
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\query\PortfolioCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \omcrn\portfolio\models\query\PortfolioCategoryQuery(get_called_class());
    }
}
