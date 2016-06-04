<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use yii\jui\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\widgets\FileInput;
use kartik\select2\Select2;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = 'Customary Inbound Vehicle Registion.';
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Registion.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="permit-car-form">
    <style>
        .nav-tabs-justified > .active > a, .nav-tabs-justified > .active > a:hover, .nav-tabs-justified > .active > a:focus {
            background: #701980 none repeat scroll 0 0;
            color:#fff;
            border: 1px solid #ddd;
        }
    </style>
    <div>
        <?php $form = ActiveForm::begin(); ?>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs-justified nav-justified">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-car"></span> ข้อมูลรถ</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user-secret" aria-hidden="true"></i>
                    คนขับรถ</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    ข้อมูล กรมธรรภ์</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="panel panel-primary">
                    <div class="panel-heading">ข้อมูลรถ</div>
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
                            <div class="col-md-6">
                                <span>เอกสารแนบ(สำเนาบัตรประจำตัวประชาชน,สำเนา Passport)</span>
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
                            <div class="col-md-6">
                                <span>รูปภาพรถ</span>
                                <?=
                                $form->field($model, 'IMAGE_REF[]')->widget(FileInput::classname(), [
                                    'options' => [
                                        'accept' => 'image/*',
                                        'multiple' => true,
                                    ],
                                    'pluginOptions' => [
                                        //'initialPreview' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                                        // 'initialPreviewConfig' => $model->initialPreview($model->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
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
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="panel panel-default">
                    <div class="panel-heading">ข้อมูลคนขับรถ</div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                <div class="panel panel-default">
                    <div class="panel-heading">กรมธรรม์</div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <div class="panel panel-default">
                    <div class="panel-heading">ข้อมูลคนขับรถ</div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-5">
            <?= Html::submitButton('Save', ['class' => 'btn btn-block btn-success']) ?>
        </div>
        <div class="col-lg-offset-0 col-lg-5">
            <?= Html::resetButton('Cancel', ['class' => 'btn btn-block btn-danger']) ?><br>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>


