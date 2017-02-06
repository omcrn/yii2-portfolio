<?php

namespace omcrn\portfolio\models;

use Yii;

/**
 * This is the model class for table "{{%om_portfolio_item_attachment_translation}}".
 *
 * @property integer $id
 * @property integer $item_attachment_id
 * @property string $title
 * @property string $description
 *
 * @property PortfolioItemAttachment $itemAttachment
 */
class PortfolioItemAttachmentTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%om_portfolio_item_attachment_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_attachment_id'], 'required'],
            [['item_attachment_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['item_attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => PortfolioItemAttachment::className(), 'targetAttribute' => ['item_attachment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('portfolio', 'ID'),
            'item_attachment_id' => Yii::t('portfolio', 'Item Attachment ID'),
            'title' => Yii::t('portfolio', 'Title'),
            'description' => Yii::t('portfolio', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemAttachment()
    {
        return $this->hasOne(PortfolioItemAttachment::className(), ['id' => 'item_attachment_id']);
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\query\PortfolioItemAttachmentTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \omcrn\portfolio\models\query\PortfolioItemAttachmentTranslationQuery(get_called_class());
    }
}
