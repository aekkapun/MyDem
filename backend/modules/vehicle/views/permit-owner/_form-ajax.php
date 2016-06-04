<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\helpers\Url;
//use Model
use backend\modules\master\models\Title;
use backend\modules\master\models\Country;
use backend\modules\master\models\PassportType;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitOwner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-owner-form">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>
    <div class="panel-body">
        <?= $form->errorSummary($model, ['header' => 'XXXX']); ?>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'PSLNUM')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>คำนำหน้าชื่อ</label>
                <?=
                $form->field($model, 'OWNER_TITLE')->widget(Select2::classname(), [
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
            <div class="col-md-4">
                <label>ชื่อ(Firstname)</label>
                <?= $form->field($model, 'OWNER_FNME')->textInput(['maxlength' => true, 'placeholder' => 'Firstname'])->label(false) ?>
            </div>
            <div class="col-md-4">
                <label>นามสกุล(Lastname)</label>
                <?= $form->field($model, 'OWNER_LNME')->textInput(['maxlength' => true, 'placeholder' => 'Lastname'])->label(false) ?>
            </div>
            <div class="col-md-2">
                <label>อายุ(Age)</label>
                <?= $form->field($model, 'OWNER_AGE')->textInput(['maxlength' => true, 'placeholder' => 'Age.'])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <style>
                .element.style{
                    position: absolute;
                    top: 392px;
                    left: 982.328px;
                    z-index: 2;
                    display: block;
                }
                .input-group {
                    position: relative;
                    display: table;
                    border-collapse: separate;
                    z-index: 0;
                }
            </style>
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
                <label>เลขที่ Passport</label>
                <?= $form->field($model, 'PASPOTNUM')->textInput(['maxlength' => true, 'placeholder' => 'Passport No.'])->label(false) ?>
            </div>
            <div class="col-md-3">
                <?=
                $form->field($model, 'PASPOT_ISSUE')->widget(DatePicker::classname(), [
                    'language' => 'en',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ],
                    'options' => [
                        'class' => 'form-control',
                        'readonly' => 'readonly',
                        'placeholder' => 'Date Of Issue.'
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
                    ],
                    'options' => [
                        'class' => 'form-control',
                        'readonly' => true,
                        'placeholder' => 'Date Of Expire.'
                    ]
                ])->label()
                ?>
            </div>
        </div>


        <div class="row">

            <div class="col-md-4">
                <label>ที่อยู่</label>
                <?= $form->field($model, 'ADDR')->textInput(['maxlength' => true, 'placeholder' => 'Address'])->label(FALSE) ?>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
                <label>จังหวัด/รัฐ</label>
                <?=
                $form->field($model, 'PROVINCE_ID')->widget(DepDrop::classname(), [
                    'options' => [
                    //'id' => 'ddl-amphur'
                    ],
                    'data' => $province_na,
                    'pluginOptions' => [
                        'depends' => ['permitowner-icc'],
                        'placeholder' => 'Province/State',
                        'url' => Url::to(['/car/permit-request/get-province-national'])
                    ]
                ])->label(false);
                ?>
            </div>
            <div class="col-md-2">
                <label>รหัสไปรษณีย์</label>
                <?= $form->field($model, 'POSCDE')->textInput(['maxlength' => true, 'placeholder' => 'Post Code'])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label>โทรศัพท์</label>
                <?= $form->field($model, 'TELEPHONE')->textInput(['maxlength' => true, 'placeholder' => 'Telephone'])->label(false) ?>
            </div>
            <div class="col-md-3">
                <label>e-Mail</label>
                <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true, 'placeholder' => 'e - Mail'])->label(false) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <span>เอกสารแนบ(สำเนาบัตรประจำตัวประชาชน,สำเนา Passport)</span>
                <?=
                $form->field($model, 'ATTRACT_FILE')->widget(FileInput::classname(), [
                    'options' => [
                        'accept' => 'image/*',
                        'multiple' => true,
                    ],
                    'pluginOptions' => [
                        //'initialPreview' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                        //'initialPreviewConfig' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
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
