<?php

namespace omcrn\portfolio\models;

use Yii;

/**
 * This is the model class for table "{{%om_portfolio_item_attachment}}".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $path
 * @property string $mime
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property PortfolioItem $item
 * @property PortfolioItemAttachmentTranslation[] $omPortfolioItemAttachmentTranslations
 */
class PortfolioItemAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%om_portfolio_item_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'path', 'mime'], 'required'],
            [['item_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['path'], 'string', 'max' => 512],
            [['mime'], 'string', 'max' => 15],
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
            'path' => Yii::t('portfolio', 'Path'),
            'mime' => Yii::t('portfolio', 'Mime'),
            'status' => Yii::t('portfolio', 'Status'),
            'created_at' => Yii::t('portfolio', 'Created At'),
            'updated_at' => Yii::t('portfolio', 'Updated At'),
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
    public function getPortfolioItemAttachmentTranslations()
    {
        return $this->hasMany(PortfolioItemAttachmentTranslation::className(), ['item_attachment_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\query\PortfolioItemAttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \omcrn\portfolio\models\query\PortfolioItemAttachmentQuery(get_called_class());
    }
}
