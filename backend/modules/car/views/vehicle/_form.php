<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
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
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-request-form">
    <div class="panel panel-primary">
        <div class="panel-heading">ข้อมูลการขออนุญาต  <?= $model->REQ_REF ?></div>
        <div class="panel-body">

            <?php
            $form = ActiveForm::begin([
                        'layout' => 'default',
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ],
            ]);
            ?>
            <?= $form->errorSummary($model); ?>
            <div class="row">
                <div class="col-md-4">
                    <label>จากประเทศ</label>
                    <?=
                    $form->field($modelRequest, 'COUNTRY')->widget(Select2::classname(), [
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
                <div class="col-md-4">
                    <label>ผ่านจังหวัด</label>
                    <?=
                    $form->field($modelRequest, 'ROUTE_PROVINCE')->widget(DepDrop::classname(), [
                        'options' => [
                        //'id' => 'ddl-amphur'
                        ],
                        'data' => $province_th,
                        'pluginOptions' => [
                            'depends' => ['permitrequest-country'],
                            'placeholder' => 'Province Of Thailand...',
                            'url' => Url::to(['/car/vehicle-registion/get-province'])
                        ]
                    ])->label(false);
                    ?>
                </div>
                <div class="col-md-4">
                    <label>ด่านศุลกากร</label>
                    <?php // $form->field($model, 'ROUTE_BODER_POINT')->textInput()->label(FALSE) ?>
                    <?=
                    $form->field($modelRequest, 'ROUTE_BODER_POINT')->widget(DepDrop::classname(), [
                        'options' => [
                        //'id' => 'ddl-amphur'
                        ],
                        'data' => $border_th,
                        'pluginOptions' => [
                            'depends' => ['permitrequest-route_province'],
                            'placeholder' => 'Boder Point...',
                            'url' => Url::to(['/car/vehicle-registion/get-border'])
                        ]
                    ])->label(false);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    เขตท้องที่การใช้รถ
                    <?= $form->field($modelRequest, 'ROUTE_DETAIL')->textInput(['maxlength' => true, 'placeholder' => 'ระบบตำบล อำเภอ จังหวัด (ROUTE DETAIL)'])->label(false) ?>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">ข้อมูลเจ้าของรถ</div>
                <div class="panel-body">
                    <?= $form->errorSummary($model); ?>
                    <?= $form->field($model, 'IMAGE_REF')->hiddenInput(['maxlength' => 50])->label(false); ?>

                    <?= $form->field($model, 'TSPMDE')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'VHCLCN1')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'VHCLCN2')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'VHCPRV')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'VHCCTY')->textInput() ?>

                    <div class="row">
                        <div class="col-md-12">
                            <span>เอกสารแนบ(สำเนาบัตรประจำตัวประชาชน,สำเนา Passport)</span>
                            <?=
                            $form->field($model, 'ATTACH_FILE[]')->widget(FileInput::classname(), [
                                'options' => [
                                    'accept' => 'image/*',
                                    'multiple' => true,
                                ],
                                'pluginOptions' => [
                                    //'initialPreview' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'file'),
                                    //'initialPreviewConfig' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'config'),
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
                    </div>
                    <div class="form-group field-upload_files">
                        <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
                        <div>
                            <?=
                            FileInput::widget([
                                'name' => 'upload_ajax[]',
                                'options' => ['multiple' => true, 'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                                'pluginOptions' => [
                                    'overwriteInitial' => false,
                                    'initialPreviewShowDelete' => true,
//                                    'initialPreview' => $initialPreviewAjax,
//                                   'initialPreviewConfig' => $initialPreviewConfigAjax,
                                    'uploadUrl' => Url::to(['/car/test/upload-ajax']),
                                    'uploadExtraData' => [
                                        'ref' => $model->IMAGE_REF,
                                    ],
                                    'maxFileCount' => 4,
                                ]
                            ]);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <hr/>
                <div class="col-md-6 col-xs-6">
                    <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i> บันทึกคำขอ' : 'อัพเดทข้อมูล', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . '   btn-block']) ?>
                </div>
                <div class="col-md-6 col-xs-6">
                    <?= Html::resetButton($model->isNewRecord ? '<i class="glyphicon glyphicon-refresh"></i> เคลียร์ข้อมูล' : 'คืนค่าเดิม', ['class' => ($model->isNewRecord ? 'btn btn-danger' : 'btn btn-warning') . '   btn-block']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
