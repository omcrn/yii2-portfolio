<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model omcrn\portfolio\models\PortfolioItem */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $categories omcrn\portfolio\models\PortfolioCategory[] */
/* @var $locales array */
/* @var $translationModel \omcrn\portfolio\models\PortfolioItem */
?>

<div class="portfolio-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'category_ids', [
        'inputOptions' => [
            'multiple' => 'multiple'
        ]
    ])->dropDownList($categories) ?>

    <?php
    if (isset($locales)) {
        $items = [];
        $ind = 0;
        foreach ($locales as $key => $locale) {
            $title = $locale;
            $translationModel = $model->findTranslationByLocale($key);

            $content = $this->render('_tab_content', [
                'form' => $form,
                'model' => $translationModel,
                'language' => $key,
            ]);

            $items[] = [
                'label' => $title,
                'content' => $content,
                'headerOptions' => [
                    'title' => $translationModel->hasErrors() ? Yii::t('i18ncontent', 'You have validation errors') : "",
                    'class' => $translationModel->hasErrors() ? 'has-error' : '',
                    'data-toggle' => 'tooltip'
                ],
                'options' => [
                    'class' => 'fade' . ($ind++ === 0 ? ' in' : '')
                ]

            ];
        }
        echo '<div class="tab-wrapper">';
        echo Tabs::widget([
            'items' => $items
        ]);
        echo '</div>';
    } else {
        echo $this->render('_tab_content', [
            'form' => $form,
            'model' => $model
        ]);
    }

    ?>

    <div class="om-file-crop-input attachment-list">
    </div>
    <?php $this->registerJs('$(\'.om-file-crop-input\').omFileInput()') ?>

    <div id="om-file-input-cropper-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Crop uploaded file</h3>
                </div>
                <div class="modal-body">
                    <img src="" alt="">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <?php echo $form->field($model, 'start_date')->widget(
        'trntv\yii\datetime\DateTimeWidget',
        [
            'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
        ]
    ) ?>

    <?php echo $form->field($model, 'end_date')->widget(
        'trntv\yii\datetime\DateTimeWidget',
        [
            'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
        ]
    ) ?>

    <?php // echo $form->field($model, 'sort_order')->textInput() ?>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('portfolio', 'Create') : Yii::t('portfolio', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
