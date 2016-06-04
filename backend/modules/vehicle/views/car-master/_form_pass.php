<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
use backend\modules\master\models\Title;
use backend\modules\master\models\Country;
use backend\modules\master\models\Province;
use backend\modules\master\models\CustBorderPoint;
use backend\modules\master\models\PassportType;
use backend\modules\master\models\Color;
use yii\web\UploadedFile;
use yii\helpers\Json;
use kartik\widgets\DepDrop;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\CarMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-master-form">

    <?php
    $form = ActiveForm::begin([
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-4',
                        'offset' => 'col-sm-offset-4',
                        'wrapper' => 'col-sm-8',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
                'options' => ['enctype' => 'multipart/form-data']]);
    ?>

<?= $form->field($model, 'IMAGE_REF')->hiddenInput(['maxlength' => true])->label(false) ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="fa fa-road"> ROUTE</span>
        </div>
        <div class="panel-body">
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
        </div>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading"><span class="fa fa-car"></span> ข้อมูลรถ</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <label>ประเภทรถ</label>
                    <?= $form->field($model, 'TSPMDE')->textInput(['maxlength' => true])->label(false) ?>
                    <?=
                    $form->field($model, 'TSPMDE')->widget(Select2::classname(), [
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
                <div class="col-md-3">
                    <label>หมวดทะเบียน</label>
<?= $form->field($model, 'VHCLCN1')->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-3">
                    <label>ทะเบียน</label>
<?= $form->field($model, 'VHCLCN2')->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-3">
                    <label>ทะเบียนจังหวัด</label>
<?= $form->field($model, 'VHCPRV')->textInput(['maxlength' => true])->label(false) ?>
                </div>

            </div>
            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'VHCCTY')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'VHCVERNUM')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'VHCBANCDE')->textInput() ?>
                </div>
                <div class="col-md-3">
<?= $form->field($model, 'CARCATE')->textInput() ?>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'VHCTYP')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'CARAPPR')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'VHCMDLCDE')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
<?= $form->field($model, 'CORCDE')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($model, 'VHCYER')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'CHSNUM')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ENENUM')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
<?= $form->field($model, 'CC')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'HP')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'KW')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ENG_TYP')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
<?= $form->field($model, 'FUEL_TYP')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'GPS')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'WGT')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'TOTAL_WGT')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
<?= $form->field($model, 'TOTPSG')->textInput() ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'ATTACH_FILE[]')->widget(FileInput::classname(), [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                            'initialPreview' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'file'), // ใช้ตัวที่อยู่ใน MOdel
                            'initialPreviewConfig' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'config'),
                            'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg'],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial' => false,
                            'initialPreviewAsData' => true,
//                    'previewSettings' => [
//                        'image' => ['width' => '50 px', 'height' => 'auto']
//                    ],
                            'maxFileSize' => 2800
                        ]
                    ]);
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
                            'initialPreview' => $initialPreview, // ใช้ในส่วน Controller
                            'initialPreviewConfig' => $initialPreviewConfig,
                            'initialPreviewAsData' => true,
                            'uploadUrl' => Url::to(['/vehicle/car-master/upload-ajax']),
                            'uploadExtraData' => [
                                'ref' => $model->IMAGE_REF,
                            ],
                            'maxFileCount' => 4,
                            'minFileCount' => 2,
                            'maxFileSize' => 2800
                        ]
                    ]);
                    ?>

                </div>
            </div>

        </div>
    </div>
    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
