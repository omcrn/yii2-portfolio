<?php

namespace omcrn\portfolio\models\query;

/**
 * This is the ActiveQuery class for [[\omcrn\portfolio\models\PortfolioItemAttachmentTranslation]].
 *
 * @see \omcrn\portfolio\models\PortfolioItemAttachmentTranslation
 */
class PortfolioItemAttachmentTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\PortfolioItemAttachmentTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\PortfolioItemAttachmentTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
