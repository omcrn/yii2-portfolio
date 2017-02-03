<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioCategory */

$this->title = Yii::t('portfolio', 'Create {modelClass}', [
    'modelClass' => 'Portfolio Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('portfolio', 'Portfolio Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
