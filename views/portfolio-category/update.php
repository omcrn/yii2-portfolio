<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioCategory */

$this->title = Yii::t('portfolio', 'Update {modelClass}: ', [
    'modelClass' => 'Portfolio Category',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('portfolio', 'Portfolio Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('portfolio', 'Update');
?>
<div class="portfolio-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
