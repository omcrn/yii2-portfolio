<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel omcrn\portfolio\models\search\PortfolioItem */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('portfolio', 'Portfolio Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-item-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('portfolio', 'Create {modelClass}', [
            'modelClass' => 'Portfolio Item',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'slug',
            'thumbnail',
            'start_date',
            'end_date',
            // 'sort_order',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
