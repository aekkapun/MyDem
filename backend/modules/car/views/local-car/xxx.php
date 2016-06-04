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