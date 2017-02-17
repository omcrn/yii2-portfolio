<?php

namespace omcrn\portfolio\models\search;

use omcrn\portfolio\models\PortfolioCategoryTranslation;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use omcrn\portfolio\models\PortfolioCategory;

/**
 * PortfolioCategorySearch represents the model behind the search form about `omcrn\portfolio\models\PortfolioCategory`.
 */
class PortfolioCategorySearch extends PortfolioCategory
{
    public $slug;
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'name'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PortfolioCategory::find()
            ->joinOnActiveTranslation();
        $att = PortfolioCategoryTranslation::tableName();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $dataProvider->sort->attributes['slug'] = [
            'asc' => ["$att.slug" => SORT_ASC],
            'desc' => ["$att.slug" => SORT_DESC]
        ];
        $dataProvider->sort->attributes['name'] = [
            'asc' => ["$att.name" => SORT_ASC],
            'desc' => ["$att.name" => SORT_DESC]
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query
            ->andFilterWhere(['like', $att . '.slug', $this->slug])
            ->andFilterWhere(['like', $att . '.name', $this->name]);

        return $dataProvider;
    }
}
