<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitDriver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CAR_ID')->textInput() ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'PSLNUM')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_TITLE')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_FNME')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_LNME')->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'PASPOTTYP')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'PASPOTNUM')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'PASPOT_ISSUE')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'PASPOT_EXP')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_LICENSE_TYPE')->textInput() ?>
        </div> 
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_LICENSE_NO')->textInput(['maxlength' => true]) ?>
        </div> 
        <div class="col-md-3">
            <?= $form->field($model, 'LICENSE_ISSUE')->textInput() ?>
        </div> 
        <div class="col-md-3">
            <?= $form->field($model, 'LICENSE_EXP')->textInput() ?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'ADDR')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ICC')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'PROVINCE_ID')->textInput() ?>
        </div>
        <div class="col-md-2">

            <?= $form->field($model, 'POSCDE')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <?=
                            $form->field($model, 'ATTACHFILE_PASSPORT[]')->widget(FileInput::classname(), [
                                'options' => [
                                    'accept' => 'image/*',
                                    'multiple' => true,
                                ],
                                'pluginOptions' => [
                                    'initialPreview' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                                    'initialPreviewConfig' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
                                    'allowedFileExtensions' => ['jpg', 'png', 'pdf'],
                                    'showPreview' => true,
                                    'showCaption' => true,
                                    'showRemove' => FALSE,
                                    'showUpload' => FALSE,
                                    'overwriteInitial' => false,
                                    'browseClass' => 'btn btn-primary btn-block',
                                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                    'browseLabel' => 'แนบรูปภาพ'
                                ]
                            ])->label(false);
                            ?>
    </div>
    <div class="row">
        <?=
                            $form->field($model, 'ATTACHFILE_DRIVERLC[]')->widget(FileInput::classname(), [
                                'options' => [
                                    'accept' => 'image/*',
                                    'multiple' => true,
                                ],
                                'pluginOptions' => [
                                    'initialPreview' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                                    'initialPreviewConfig' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
                                    'allowedFileExtensions' => ['jpg', 'png', 'pdf'],
                                    'showPreview' => true,
                                    'showCaption' => true,
                                    'showRemove' => FALSE,
                                    'showUpload' => FALSE,
                                    'overwriteInitial' => false,
                                    'browseClass' => 'btn btn-primary btn-block',
                                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                    'browseLabel' => 'แนบรูปภาพ'
                                ]
                            ])->label(false);
                            ?>
    </div>
    <?= $form->field($model, 'REF_NUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DRIVER_MNME')->textInput(['maxlength' => true]) ?>









    <?= $form->field($model, 'LICENSE_DLT_OfFICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LICENSE_BR_CODE')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'TUMBON_ID')->textInput() ?>

    <?= $form->field($model, 'AMPHUR_ID')->textInput() ?>


    <?= $form->field($model, 'DLT_APR_ID')->textInput() ?>

    <?= $form->field($model, 'DLT_APR_DTE')->textInput() ?>

    <?= $form->field($model, 'DLT_APR_STS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DLT_APR_DSC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ATTACHFILE_PASSPORT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ATTACHFILE_DRIVERLC')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
