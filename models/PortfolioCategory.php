<?php

namespace omcrn\portfolio\models;

use omcrn\portfolio\TranslatableModelTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%om_portfolio_category}}".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property PortfolioCategoryItem[] $categoryItems
 * @property PortfolioCategoryTranslation[] $translations
 * @property PortfolioCategoryTranslation $activeTranslation
 */
class PortfolioCategory extends \yii\db\ActiveRecord
{
    use TranslatableModelTrait;

    /**
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @var PortfolioCategoryTranslation[]
     */
    public $newTranslations = [];

    public static $translateModelForeignKey = 'category_id';

    public static $translateModel = PortfolioCategoryTranslation::class;

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
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('portfolio', 'ID'),
            'status' => Yii::t('portfolio', 'Status'),
            'created_at' => Yii::t('portfolio', 'Created At'),
            'updated_at' => Yii::t('portfolio', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryItems()
    {
        return $this->hasMany(PortfolioCategoryItem::className(), ['category_id' => 'id']);
    }

    /**
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(PortfolioCategoryTranslation::className(), ['category_id' => 'id']);
    }

    /**
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @return \yii\db\ActiveQuery
     */
    public function getActiveTranslation()
    {
        return $this->hasOne(PortfolioCategoryTranslation::className(), ['category_id' => 'id'])->where([
            'locale' => Yii::$app->language
        ]);
    }

    /**
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @inheritdoc
     */
    public function load($postData, $formName = null)
    {
//        \centigen\base\helpers\UtilHelper::vardump($postData);
        if (!parent::load($postData, $formName)) {
            return false;
        }

        $className = \yii\helpers\StringHelper::basename(PortfolioCategoryTranslation::className());
        $translations = ArrayHelper::getValue($postData, $className);
        $this->newTranslations = [];

        $allValid = true;
        if(!empty($translations)){
            foreach ($translations as $loc => & $modelData) {
                $modelData['locale'] = $loc;

//                if (isset($modelData['body'])) {
//                    $modelData['body'] = Html::encodeMediaItemUrls($modelData['body']);
//                }
//                if (isset($modelData['short_description']) &&
//                    ($this->hasAttribute('short_description') || $this->hasProperty('short_description'))) {
//                    $this ->short_description = Html::encodeMediaItemUrls($modelData['short_description']);
//                }

//                if (Yii::$app->language === $loc && isset($modelData['title']) &&
//                    ($this->hasAttribute('title') || $this->hasProperty('title'))
//                ) {
//                    $this->title = $modelData['title'];
//                }

                $translation = $this->findTranslationByLocale($loc);
//                \centigen\base\helpers\UtilHelper::vardump($translation);exit;
                $this->newTranslations[] = $translation;
                if (!$translation->load($modelData, '')) {
                    $allValid = false;
                }
            }
        }

        return $allValid;
    }

    /**
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->validate() || !parent::save($runValidation, $attributeNames)) {
            return false;
        }

        $allSaved = true;
        foreach ($this->newTranslations as $translation) {
            $translation->category_id = $this->id;
            if (!$translation->save()) {
                $allSaved = false;
            }
        }

        if ($allSaved) {
            $transaction->commit();
        } else {
            $transaction->rollBack();
        }

        return $allSaved;
    }

//    public static function getCategories()
//    {
//        $return = [];
//        $categories = self::find() ->all();
//        foreach ($categories as $cat){
//            $return[$cat['id']] = $cat['name'];
//        }
//        return $return;
//    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\query\PortfolioCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \omcrn\portfolio\models\query\PortfolioCategoryQuery(get_called_class());
    }
}
