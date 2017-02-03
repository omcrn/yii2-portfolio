<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('portfolio', 'Portfolio Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-item-view">

    <p>
        <?php echo Html::a(Yii::t('portfolio', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('portfolio', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('portfolio', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
            'thumbnail',
            'start_date',
            'end_date',
            'sort_order',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
