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
/* @var $model backend\modules\car\models\PermitCar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-car-form">

    <?php
    $form = ActiveForm::begin([
                'layout' => 'default',
                'options' => [
                    'enctype' => 'multipart/form-data'
                ],
    ]);
    ?>
    <div class="panel panel-success">
        <div class="panel-heading"><span class="fa fa-car"></span> ข้อมูลรถ</div>
        <div class="panel-body">
            <div class="row">
                <div class="row">
                     <?= $form->field($model, 'IMAGE_REF')->textInput(['maxlength' => 50])->label(); ?>
                </div>
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
                    <span>เอกสารแนบเอกสารประกอบการจดทะเบียน</span>
                    <?=
                    $form->field($model, 'ATTACH_FILE[]')->widget(FileInput::classname(), [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => true,
                        ],
                        'pluginOptions' => [
                            //'initialPreview' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                            // 'initialPreviewConfig' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
                            'allowedFileExtensions' => ['jpg', 'png', 'pdf'],
                            // 'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => FALSE,
                            'showUpload' => FALSE,
                            'overwriteInitial' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' => 'แนบไฟล์',
                            'maxFileCount' => 2
                        ]
                    ])->label(false);
                    ?>
                </div>
            </div>
            <div class="row">
                <?=
                FileInput::widget([
                    'name' => 'upload_ajax[]',
                    'options' => ['multiple' => true, 'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                    'pluginOptions' => [
                        'overwriteInitial' => false,
                        'initialPreviewShowDelete' => true,
                        'initialPreview' => $initialPreview,
                        'initialPreviewConfig' => $initialPreviewConfig,
                        'uploadUrl' => Url::to(['/car/permit-car/upload-ajax']),
                        'uploadExtraData' => [
                            'ref' => $model->REQ_REF,
                        ],
                        'maxFileCount' => 4
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
