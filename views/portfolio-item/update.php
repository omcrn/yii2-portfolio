<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioItem */

$this->title = Yii::t('portfolio', 'Update {modelClass}: ', [
        'modelClass' => 'Portfolio Item',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('portfolio', 'Portfolio Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('portfolio', 'Update');
?>
<div class="portfolio-item-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
