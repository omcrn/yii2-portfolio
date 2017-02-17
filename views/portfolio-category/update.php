<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioCategory */
/* @var $locales array */

$this->title = Yii::t('portfolio', 'Update {modelClass}: ', [
        'modelClass' => 'Portfolio Category',
    ]) . ' ' . $model->activeTranslation->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('portfolio', 'Portfolio Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->activeTranslation->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('portfolio', 'Update');
?>
<div class="portfolio-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'locales' => $locales

    ]) ?>

</div>
