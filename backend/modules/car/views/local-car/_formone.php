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
                    $form->field($model, 'COUNTRY')->widget(Select2::classname(), [
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
                    $form->field($model, 'ROUTE_PROVINCE')->widget(DepDrop::classname(), [
                        'options' => [
                        //'id' => 'ddl-amphur'
                        ],
                        'data' =>$province_th,
                        'pluginOptions' => [
                            'depends' => ['permitrequest-country'],
                            'placeholder' => 'Province Of Thailand...',
                            'url' => Url::to(['/car/permit-request/get-province'])
                        ]
                    ])->label(false);
                    ?>
                </div>
                <div class="col-md-4">
                    <label>ด่านศุลกากร</label>
                    <?php // $form->field($model, 'ROUTE_BODER_POINT')->textInput()->label(FALSE) ?>
                    <?=
                    $form->field($model, 'ROUTE_BODER_POINT')->widget(DepDrop::classname(), [
                        'options' => [
                        //'id' => 'ddl-amphur'
                        ],
                        'data' => $border_th,
                        'pluginOptions' => [
                            'depends' => ['permitrequest-route_province'],
                            'placeholder' => 'Boder Point...',
                            'url' => Url::to(['/car/permit-request/get-border'])
                        ]
                    ])->label(false);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    เขตท้องที่การใช้รถ
                    <?= $form->field($model, 'ROUTE_DETAIL')->textInput(['maxlength' => true, 'placeholder' => 'ระบบตำบล อำเภอ จังหวัด (ROUTE DETAIL)'])->label(false) ?>
                </div>
            </div>
            <?php
            $this->render('xxx');
            ?>
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
