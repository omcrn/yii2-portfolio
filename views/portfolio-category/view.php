<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('portfolio', 'Portfolio Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-category-view">

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
            'name',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
