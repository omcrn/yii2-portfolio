<?php

/* @var $this yii\web\View */
/* @var $language string */
/* @var $model centigen\i18ncontent\models\ArticleCategoryTranslation */
/* @var $form yii\bootstrap\ActiveForm */

$className = \yii\helpers\StringHelper::basename(\omcrn\portfolio\models\PortfolioCategoryTranslation::className());

?>

<?php echo $form->field($model, 'slug', [
    'inputOptions' => [
        'name' => "{$className}[$language][slug]"
    ]
])
    ->hint(Yii::t('portfolio', 'If you\'ll leave this field empty, slug will be generated automatically'))
    ->textInput(['maxlength' => 256]) ?>

<?php echo $form->field($model, 'name', [
    'inputOptions' => [
        'name' => "{$className}[$language][name]"
    ]
])->textInput(['maxlength' => 256]) ?>
