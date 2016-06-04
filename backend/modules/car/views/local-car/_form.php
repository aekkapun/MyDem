<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
use backend\modules\master\models\Title;
use backend\modules\master\models\Country;
use backend\modules\master\models\Province;
use backend\modules\master\models\CustBorderPoint;
use backend\modules\master\models\PassportType;
use yii\web\UploadedFile;
use yii\helpers\Json;
use kartik\widgets\DepDrop;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoLibrary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-library-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model) ?>

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

    <?= $form->field($model, 'IMAGE_REF')->hiddenInput(['maxlength' => 50])->label(false); ?>

    <?= $form->field($model, 'VHCLCN1')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'VHCLCN2')->textarea(['rows' => 3]) ?>


    <?= $form->field($model, 'VHCPRV')->textInput(['maxlength' => 255]) ?>

    <div class="row">
        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'CHSNUM')->textInput(['maxlength' => 150]) ?>
        </div>
        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'ENENUM')->textInput(['maxlength' => 20]) ?>
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
                    'initialPreview' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'file'),
                    'initialPreviewConfig' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'config'),
                    'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg'],
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                    'overwriteInitial' => false,
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
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'uploadUrl' => Url::to(['/car/vehicle-register/upload-ajax']),
                    'uploadExtraData' => [
                        'ref' => $model->IMAGE_REF,
                    ],
//                    'previewSettings' => [
//                        'image' => ['width' => '50 px', 'height' => '100']
//                    ],
                    'maxFileCount' => 4,
                    'maxFileCount' => 2,
                    'maxFileSize' => 2800
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
