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


    <div class="panel panel-success">
        <div class="panel-heading"><span class="fa fa-car"></span> ข้อมูลรถ</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <label>ประเภทรถ</label>
                    <?= $form->field($model, 'TSPMDE')->textInput(['maxlength' => true])->label(false) ?>
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
                            //'initialPreview' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'file'),
                            //'initialPreviewConfig' => $model->initialPreview($model->ATTACH_FILE, 'ATTACH_FILE', 'config'),
                            'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'jpeg', 'png', 'jpg'],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial' => false,
//                    'previewSettings' => [
//                        'image' => ['width' => '50 px', 'height' => 'auto']
//                    ],
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
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
