<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\master\models\Title;
use backend\modules\master\models\Country;
use backend\modules\master\models\Province;
use backend\modules\master\models\CustBorderPoint;
use backend\modules\master\models\PassportType;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitDriver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-driver-form">


    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'CAR_ID')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'REF_NUMBER')->hiddenInput(['maxlength' => true])->label(false) ?>
    <div class="row">
        <div class="col-md-3">
            <label>คำนำหน้า</label>
            <?=
            $form->field($model, 'DRIVER_TITLE')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Title::find()->all(), 'TITLE_ID', 'Fulltitle'),
                'options' => ['placeholder' => ' Title ...',
                //  'id' => 'ddl-cat'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?> 
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_FNME')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_LNME')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'PSLNUM')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>ประเภท Passport</label>
            <?=
            $form->field($model, 'PASPOTTYP')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(PassportType::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Passport Type ...',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'PASPOTNUM')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'PASPOT_ISSUE')->widget(DatePicker::classname(), [
                'language' => 'en',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                    'readOnly' => true,
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Date Of Expire.'
                ]
            ])->label()
            ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'PASPOT_EXP')->widget(DatePicker::classname(), [
                'language' => 'en',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                    'readOnly' => true,
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Date Of Expire.'
                ]
            ])->label()
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'DRIVER_LICENSE_TYPE')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'DRIVER_LICENSE_NO')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'LICENSE_ISSUE')->widget(DatePicker::classname(), [
                'language' => 'en',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                    'readOnly' => true,
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Date Of Expire.'
                ]
            ])->label()
            ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'LICENSE_EXP')->widget(DatePicker::classname(), [
                'language' => 'en',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                    'readOnly' => true,
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Date Of Expire.'
                ]
            ])->label()
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'ADDR')->textInput(['maxlength' => true]) ?> 
        </div>
        <div class="col-md-4">
            <label>ประเทศ</label>
            <?=
            $form->field($model, 'ICC')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Country::find()->where(['STATUS' => 'LC'])->orderBy(['COUNTRY_ID' => SORT_DESC,])->all(), 'COUNTRY_CODE', 'COUNTRY_DESC'),
                'options' => ['placeholder' => 'Country ...',
                //'id' => 'ddl-province-start',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?=
            $form->field($model, 'ATTACHFILE_PASSPORT')->widget(FileInput::classname(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => false,
                ],
                'pluginOptions' => [
                    'initialPreview' => $model->initialPreview($model->ATTACHFILE_PASSPORT, 'ATTACHFILE_PASSPORT', 'file'),
                    'initialPreviewConfig' => $model->initialPreview($model->ATTACHFILE_PASSPORT, 'ATTACHFILE_PASSPORT', 'config'),
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
            ])->label();
            ?>
        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'ATTACHFILE_DRIVERLC[]')->widget(FileInput::classname(), [
                    'options' => [
                    //'accept' => 'image/*',
                    'multiple' => true
                    ],
                    'pluginOptions' => [
                    'initialPreview' => $model->initialPreview($model->ATTACHFILE_DRIVERLC, 'ATTACHFILE_DRIVERLC', 'file'),
                   'initialPreviewConfig' => $model->initialPreview($model->ATTACHFILE_DRIVERLC, 'ATTACHFILE_DRIVERLC', 'config'),
                    'allowedFileExtensions' => ['pdf', 'doc', 'jpg', 'jpeg', 'xlsx'],
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                    'overwriteInitial' => false
                    ]
                    ]);
                    ?>
                </div>
            </div>
    <div class="row">
        <div class="col-md-6 col-xs-6">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก' : 'อัพเดทข้อมูล', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . '   btn-block']) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= Html::resetButton($model->isNewRecord ? '<i class="glyphicon glyphicon-refresh"></i> เคลียร์ข้อมูล' : 'คืนค่าเดิม', ['class' => ($model->isNewRecord ? 'btn btn-danger' : 'btn btn-warning') . '   btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
