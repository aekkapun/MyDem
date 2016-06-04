<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRegister */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-register-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OPERATE_TYPE')->textInput() ?>

    <?= $form->field($model, 'CAR_ID')->textInput() ?>

    <?= $form->field($model, 'REF_REQ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REF_SUCCESS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LICENSE_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REGISTER_DATE')->textInput() ?>

    <?= $form->field($model, 'EXPIRE_DATE')->textInput() ?>

    <?= $form->field($model, 'ROUTE_DETAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DLT_OFFICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DLT_BRANCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REGISTRAR_TITLE')->textInput() ?>

    <?= $form->field($model, 'REGISTRAR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PC_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RPC_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RPC_SERIAL_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
