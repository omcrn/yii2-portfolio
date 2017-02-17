<?php

namespace omcrn\portfolio\models\query;

use omcrn\portfolio\models\PortfolioCategory;
use omcrn\portfolio\models\PortfolioCategoryTranslation;

/**
 * This is the ActiveQuery class for [[\omcrn\portfolio\models\PortfolioCategory]].
 *
 * @see \omcrn\portfolio\models\PortfolioCategory
 */
class PortfolioCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    private $joinedOnTranslations = false;

    private $joinedOnActiveTranslation = false;

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\PortfolioCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \omcrn\portfolio\models\PortfolioCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @return self
     */
    public function joinOnTranslations()
    {
        if (!$this->joinedOnTranslations) {
            $tb = PortfolioCategoryTranslation::tableName();
            $this->leftJoin($tb, $tb . '.category_id = ' . PortfolioCategory::tableName() . '.id');
        }
        return $this;
    }

    /**
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @return self
     */
    public function joinOnActiveTranslation()
    {
        if (!$this->joinedOnActiveTranslation) {
            $tb = PortfolioCategoryTranslation::tableName();
            $this->leftJoin($tb, $tb . '.category_id = ' . PortfolioCategory::tableName() . ".id AND $tb.locale = :locale", ['locale' => \Yii::$app->language]);
        }
        return $this;
    }
}
