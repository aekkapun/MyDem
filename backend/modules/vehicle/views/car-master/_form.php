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
use backend\modules\master\models\VehicleType;
use backend\modules\master\models\VehicleBrand;
use backend\modules\master\models\VehicleMode;
use backend\modules\master\models\CarApperance;
use backend\modules\master\models\CarCategory;
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
                'options' => ['enctype' => 'multipart/form-data']]);
    ?>
    <?= $form->errorSummary([$model,$modelRequest],['header' => 'เกิดข้อผิดพลาด กรุณาแก้ไข']); ?>
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
                    <?=
                    $form->field($model, 'TSPMDE')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(VehicleMode::find()->all(), 'id', 'TSPMDE'),
                        'options' => ['placeholder' => 'CAR ...',
                        //'id' => 'ddl-province-start',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-12">หมายเลขทะเบียน</label>
                        <div class="col-sm-4"><?= $form->field($model, 'VHCLCN1')->textInput(['maxlength' => true])->label(false) ?></div>
                        <div class="col-sm-6"><?= $form->field($model, 'VHCLCN2')->textInput(['maxlength' => true])->label(false) ?></div>                
                    </div> 
                </div>
                <div class="col-md-3">
                    <label>ทะเบียนจังหวัด</label>
                    <?= $form->field($model, 'VHCPRV')->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-3">
                    <label>ประเทศที่รถจดแทะเบียน</label>
                    <?=
                    $form->field($model, 'VHCCTY')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Country::find()->where(['STATUS' => 'LC'])->orderBy(['COUNTRY_ID' => SORT_DESC,])->all(), 'COUNTRY_CODE', 'COUNTRY_DESC'),
                        'options' => ['placeholder' => 'CAR REGISTER ...',
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

                <div class="col-md-3">
                    <label>ยี่ห้อรถ</label>
                    <?=
                    $form->field($model, 'VHCBANCDE')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(VehicleBrand::find()->all(), 'ID', 'VHCBANNME'),
                        'options' => ['placeholder' => 'BRAND ...',
                        //'id' => 'ddl-insurance',
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ])->label(false);
                    ?>
                </div>
                <div class="col-md-3">
                    <label>ประเภทของรถยนต์</label>
                    <?=
                    $form->field($model, 'CARCATE')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(CarCategory::find()->all(), 'CAR_CATE_ID', 'CAR_CATE_NAME'),
                        'options' => ['placeholder' => 'ประเภทของรถ เช่น รถยนต์,รถบรรทุก,รถบ้าน ...',
                        //'id' => 'ddl-insurance',
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ])->label(false);
                    ?>

                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <label>ประเภทพาหนะ(wan jeep)</label>
                    <?=
                    $form->field($model, 'VHCTYP')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(VehicleType::find()->all(), 'VHCTYP', 'TYPNME'),
                        'options' => ['placeholder' => 'ประเภทรถ ...',
                        //'id' => 'ddl-insurance',
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ])->label(false);
                    ?>
                </div>
                <div class="col-md-3">
                    <label>ลักษณะรถ</label>
                    <?=
                    $form->field($model, 'CARAPPR')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(CarApperance::find()->all(), 'CAR_APPEAR_ID', 'CAR_APPEAR'),
                        'options' => ['placeholder' => 'ลักษณะรถ ...',
                        //'id' => 'ddl-insurance',
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ])->label(false);
                    ?>
                </div>
                <div class="col-md-3">
                    <label>แบบรถ</label>
                    <?= $form->field($model, 'VHCMDLCDE')->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-3">

                    <?=
                    $form->field($model, 'CORCDE')->widget(Select2::classname(), [
                        'language' => 'de',
                        //'data' => backend\modules\vehicle\models\CarMaster::itemAlias('color'),
                        'data' => ArrayHelper::map(Color::find()->all(), 'color_code', 'color'),
                        'options' => ['multiple' => true, 'placeholder' => 'เลือกสี ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
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
                            'maxFileCount' => 2,
                            'minFileCount' => 1,
                            'maxFileSize' => 2800,
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
                            'maxFileCount' => 2,
                            'minFileCount' => 1,
                            'maxFileSize' => 2800,
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-default btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' => 'Select Photo'
                        ]
                    ]);
                    ?>

                </div>
            </div>

        </div>
    </div>
    <div class="form-group">
        <div class="row">

            <div class="col-md-6 col-xs-6">
                <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i> บันทึกคำขอ' : 'อัพเดทข้อมูล', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . '   btn-block']) ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <?= Html::resetButton($model->isNewRecord ? '<i class="glyphicon glyphicon-refresh"></i> เคลียร์ข้อมูล' : 'คืนค่าเดิม', ['class' => ($model->isNewRecord ? 'btn btn-danger' : 'btn btn-warning') . '   btn-block']) ?>
            </div>
        </div>
        <hr/>
    </div>

    <?php ActiveForm::end(); ?>

</div>
