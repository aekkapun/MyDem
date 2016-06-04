<?php
use kartik\widgets\FileInput;
?>
<div class="panel panel-primary">
                    <div class="panel-heading"><span class="fa fa-car"></span> ข้อมูลรถ</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label>ประเภทรถ</label>
                                <?= $form->field($modelVehicle, 'TSPMDE')->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <label>หมวดทะเบียน</label>
                                <?= $form->field($modelVehicle, 'VHCLCN1')->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <label>ทะเบียน</label>
                                <?= $form->field($modelVehicle, 'VHCLCN2')->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <label>ทะเบียนจังหวัด</label>
                                <?= $form->field($modelVehicle, 'VHCPRV')->textInput(['maxlength' => true])->label(false) ?>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'VHCCTY')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'VHCVERNUM')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'VHCBANCDE')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'CARCATE')->textInput() ?>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'VHCTYP')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'CARAPPR')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'VHCMDLCDE')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'CORCDE')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'VHCYER')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'CHSNUM')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'ENENUM')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'CC')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'HP')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'KW')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'ENG_TYP')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'FUEL_TYP')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'GPS')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'WGT')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'TOTAL_WGT')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelVehicle, 'TOTPSG')->textInput() ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span>เอกสารแนบ(สำเนาบัตรประจำตัวประชาชน,สำเนา Passport)</span>
                                <?=
                                $form->field($modelVehicle, 'ATTACH_FILE[]')->widget(FileInput::classname(), [
                                    'options' => [
                                        'accept' => 'image/*',
                                        'multiple' => true,
                                    ],
                                    'pluginOptions' => [
                                        //'initialPreview' => $modelVehicle->initialPreview($modelVehicle->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                                        // 'initialPreviewConfig' => $modelVehicle->initialPreview($modelVehicle->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
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
                                $form->field($modelVehicle, 'IMAGE_REF[]')->widget(FileInput::classname(), [
                                    'options' => [
                                        'accept' => 'image/*',
                                        'multiple' => true,
                                    ],
                                    'pluginOptions' => [
                                        //'initialPreview' => $modelVehicle->initialPreview($modelVehicle->ATTRACT_FILE, 'ATTRACT_FILE', 'file'),
                                        // 'initialPreviewConfig' => $modelVehicle->initialPreview($modelVehicle->ATTRACT_FILE, 'ATTRACT_FILE', 'config'),
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