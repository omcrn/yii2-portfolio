<?php

namespace omcrn\portfolio\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

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
    public $category_ids = [];
    public $PortfolioCategoryItem = [];
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
            ['category_ids', 'each', 'rule' => ['integer']],
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
            'category_ids' => Yii::t('portfolio', 'Portfolio Categories'),
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
    public function save($runValidation = true, $attributeNames = null)
    {
        $transaction = Yii::$app->db->beginTransaction();
        if (parent::save()){

            if (!is_array($this->category_ids)){
                $this->category_ids = [];
            }
            $existingCategoryIds = ArrayHelper::getColumn($this->PortfolioCategoryItem, 'category_id');
            $toDeleteCategoryIds = array_diff($existingCategoryIds, $this->category_ids);
            $toAddCategoryIds = array_diff($this->category_ids, $existingCategoryIds);
            if ($this->removeCategories($toDeleteCategoryIds) && $this->addCategories($toAddCategoryIds)){
                $transaction->commit();
                return true;
            }
        }
        $transaction->rollBack();
        return false;
    }

    protected function removeCategories($categoryIds)
    {
        if (empty($categoryIds)){
            return true;
        }
        PortfolioCategoryItem::deleteAll(['item_id' => $this->id, 'category_id' => $categoryIds]);
        return true;
    }

    protected function addCategories($categoryIds)
    {
        if (empty($categoryIds)){
            return true;
        }
        $data = [];
        foreach ($categoryIds as $category_id){
            $data[] = [
                'item_id' => $this->id,
                'category_id' => $category_id
            ];
        }

        Yii::$app->db->createCommand()->batchInsert(PortfolioCategoryItem::tableName(),
            ['item_id', 'category_id'], $data)->execute();

        return true;
    }
}
