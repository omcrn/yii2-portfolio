<?php
/**
 * User: zura
 * Date: 2/16/17
 * Time: 12:53 PM
 */

namespace omcrn\portfolio\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
 * Class PortfolioCategoryTranslation
 *
 * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package omcrn\portfolio\models
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $locale
 * @property string $slug
 * @property string $name
 *
 * @property PortfolioCategoryItem[] $PortfolioCategoryItems
 */
class PortfolioCategoryTranslation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%om_portfolio_category_translation}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['locale'], 'string', 'max' => 10],
            [['slug', 'name'], 'string', 'max' => 256],
        ];
    }
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name'
            ]
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('portfolio', 'ID'),
            'category_id' => Yii::t('portfolio', 'Category ID'),
            'locale' => Yii::t('portfolio', 'locale'),
            'slug' => Yii::t('portfolio', 'Slug'),
            'name' => Yii::t('portfolio', 'Name'),
        ];
    }
}