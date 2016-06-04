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
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs-justified nav-justified">
            <li role="presentation" class="active">
                <a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-car"></span> ข้อมูลรถ</a>
            </li>
            <li role="presentation">
                <a href="#driver" aria-controls="driver" role="tab" data-toggle="tab"><i class="fa fa-user-secret" aria-hidden="true"></i>
                    คนขับรถ</a>
            </li>
            <li role="presentation">
                <a href="#insulance" aria-controls="insulance" role="tab" data-toggle="tab"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    ข้อมูล กรมธรรภ์</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="panel panel-primary">
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
            <div role="tabpanel" class="tab-pane" id="driver">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-user-secret" aria-hidden="true"></i>
                        คนขับรถ</div>
                    <div class="panel-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 4, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $modelsDriver[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'DRIVER_TITLE',
                                'DRIVER_FNME',
                                'DRIVER_MNME',
                                'DRIVER_LNME',
                                'PSLNUM',
                                'PASPOTNUM',
                                'DRIVER_LICENSE_NO',
                                'LICENSE_ISSUE',
                                'LICENSE_EXP',
                                'ATTACHFILE_PASSPORT',
                                'ATTACHFILE_DRIVERLC'
                            ],
                        ]);
                        ?>
                        <div class="container-items"><!-- widgetContainer -->
                            <?php foreach ($modelsDriver as $i => $modelDriverDriver): ?>
                                <div class="item panel panel-default"><!-- widgetBody -->
                                    <div class="panel-heading">
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelDriverDriver->isNewRecord) {
                                            echo Html::activeHiddenInput($modelDriverDriver, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, '[{$i}]PSLNUM')->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, '[{$i}]DRIVER_TITLE')->textInput() ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, '[{$i}]DRIVER_FNME')->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, '[{$i}]DRIVER_LNME')->textInput(['maxlength' => true]) ?>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]PASPOTTYP")->textInput() ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]PASPOTNUM")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]PASPOT_ISSUE")->textInput() ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]PASPOT_EXP")->textInput() ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]DRIVER_LICENSE_TYPE")->textInput() ?>
                                            </div> 
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]DRIVER_LICENSE_NO")->textInput(["maxlength" => true]) ?>
                                            </div> 
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]LICENSE_ISSUE")->textInput() ?>
                                            </div> 
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]LICENSE_EXP")->textInput() ?>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?= $form->field($modelDriverDriver, "[{$i}]ADDR")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]ICC")->textInput() ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelDriverDriver, "[{$i}]PROVINCE_ID")->textInput() ?>
                                            </div>
                                            <div class="col-md-2">

                                                <?= $form->field($modelDriverDriver, "[{$i}]POSCDE")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?=
                                            $form->field($modelDriverDriver, "[{$i}]ATTACHFILE_PASSPORT[]")->widget(FileInput::classname(), [
                                                'options' => [
                                                    'accept' => 'image/*',
                                                    'multiple' => true,
                                                ],
                                                'pluginOptions' => [
                                                    // 'initialPreview' => $modelDriverDriver->initialPreview($modelDriverDriver->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                                                    // 'initialPreviewConfig' => $modelDriverDriver->initialPreview($modelDriverDriver->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
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
                                        <div class="row">
                                            <?=
                                            $form->field($modelDriverDriver, "[{$i}]ATTACHFILE_DRIVERLC[]")->label(false)->widget(FileInput::classname(), [

                                                'options' => [

                                                    'multiple' => false,
                                                    'accept' => 'image/*',
                                                //'class' => 'optionvalue-img'
                                                ],
                                                'pluginOptions' => [

                                                    'previewFileType' => 'image',
                                                    'showCaption' => false,
                                                    'showUpload' => false,
                                                    'browseClass' => 'btn btn-default btn-sm',
                                                    'browseLabel' => ' Pick image',
                                                    'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                                                    'removeClass' => 'btn btn-danger btn-sm',
                                                    'removeLabel' => ' Delete',
                                                    'removeIcon' => '<i class="fa fa-trash"></i>',
                                                    'previewSettings' => [

                                                        'image' => ['width' => '138px', 'height' => 'auto']
                                                    ],
                                                    //'initialPreview' => $initialPreview,
                                                    'layoutTemplates' => ['footer' => '']
                                                ]
                                            ])
                                            ?>
                                            <?php /*
                                              $form->field($modelDriverDriver, "[{$i}]ATTACHFILE_DRIVERLC[]")->widget(FileInput::classname(), [
                                              'options' => [
                                              'accept' => 'image/*',
                                              'multiple' => true,
                                              ],
                                              'pluginOptions' => [
                                              ///'initialPreview' => $modelDriverDriver->initialPreview($modelDriverDriver->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                                              //  'initialPreviewConfig' => $modelDriverDriver->initialPreview($modelDriverDriver->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
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
                                             */ ?>
                                        </div>
                                    </div>
                                </div><!-- .panel -->
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div><!-- Model DRIVER -->
            </div>
            <div role="tabpanel" class="tab-pane" id="insulance">
                <div class="AccessPoint">
                    <div class="panel panel-primary">
                        <div class="panel-heading"> 
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            ข้อมูล กรมธรรม์
                        </div>
                        <div class="panel-body">
                            <?php
                            DynamicFormWidget::begin([
                                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                'widgetBody' => '.container-itemsAP', // required: css class selector
                                'widgetItem' => '.item', // required: css class
                                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                                'min' => 1, // 0 or 1 (default 1)
                                'insertButton' => '.add-itemAP', // css class
                                'deleteButton' => '.remove-itemAP', // css class
                                'model' => $modelsInsulance[0],
                                'formId' => 'dynamic-form',
                                'formFields' => [
                                    'INSURANCE_CMPNME',
                                    'INSURANCE_NO',
                                    'INSURANCE_EXP',
                                    'INSURANCE_FILE',
                                ],
                            ]);
                            ?>

                            <div class="container-itemsAP"><!-- widgetContainer -->
                                <?php foreach ($modelsInsulance as $i => $modelInsulance): ?>
                                    <div class="item panel panel-default"><!-- widgetBody -->
                                        <div class="panel-heading">

                                            <div class="pull-right">
                                                <button type="button" class="add-itemAP btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                                <button type="button" class="remove-itemAP btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                            // necessary for update action.
                                            if (!$modelInsulance->isNewRecord) {
                                                echo Html::activeHiddenInput($modelInsulance, "[{$i}]id");
                                            }
                                            ?>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>บริษัทประกัน</label>
                                                    <?= $form->field($modelInsulance, "[{$i}]INSURANCE_CMPNME")->textInput(['maxlength' => true])->label(false) ?>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <label>เลขที่ ประกัน</label>
                                                    <?= $form->field($modelInsulance, "[{$i}]INSURANCE_NO")->textInput(['maxlength' => true])->label(false) ?>
                                                </div>
                                                <div class=" col-md-4 col-sm-6">
                                                    <label>วันที่ประกันหมอายุ</label>
                                                    <?= $form->field($modelInsulance, "[{$i}]INSURANCE_EXP")->textInput(['maxlength' => true])->label(false) ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>เอกสารแนบ()</label>

                                                    <?=
                                                    $form->field($modelInsulance, "[{$i}]INSURANCE_FILE")->widget(FileInput::classname(), [
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
                                            </div><!-- .row -->

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </div><!-- modelsAccessPoint -->
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


