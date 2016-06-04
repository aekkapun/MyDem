<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitInsulance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-insulance-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?= $form->errorSummary($model); ?>
        <div class="col-md-4">
            <?= $form->field($model, 'INSURANCE_CMPNME')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'INSURANCE_NO')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?=
            
            $form->field($model, 'INSURANCE_EXP')->widget(DatePicker::classname(), [
                'language' => 'en',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => false,
                    'changeYear' => false,
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'INSURANCE_EXP'
                ]
            ])->label()
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            /*
            $form->field($model, 'INSURANCE_FILE')->widget(FileInput::classname(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true
                ],
                'pluginOptions' => [
                    // 'initialPreview' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'file'), // ใช้ตัวที่อยู่ใน MOdel
                    //'initialPreviewConfig' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'config'),
                    'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg'],
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                    'overwriteInitial' => false,
                    'initialPreviewAsData' => true,
                    'maxFileCount' => 2,
                    'minFileCount' => 1,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-default btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' => 'แนบรูปภาพ'
                ]
            ]);*/
            ?>
        </div>
    </div>
</div>


<?= $form->field($model, 'CAR_ID')->hiddenInput()->label(false) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>