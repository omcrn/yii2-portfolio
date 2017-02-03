<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioItem */

$this->title = Yii::t('portfolio', 'Create {modelClass}', [
    'modelClass' => 'Portfolio Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('portfolio', 'Portfolio Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-item-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
