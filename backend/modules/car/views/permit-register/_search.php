<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRegisterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-register-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'OPERATE_TYPE') ?>

    <?= $form->field($model, 'CAR_ID') ?>

    <?= $form->field($model, 'REF_REQ') ?>

    <?= $form->field($model, 'REF_SUCCESS') ?>

    <?php // echo $form->field($model, 'LICENSE_NO') ?>

    <?php // echo $form->field($model, 'REGISTER_DATE') ?>

    <?php // echo $form->field($model, 'EXPIRE_DATE') ?>

    <?php // echo $form->field($model, 'ROUTE_DETAIL') ?>

    <?php // echo $form->field($model, 'DLT_OFFICE') ?>

    <?php // echo $form->field($model, 'DLT_BRANCH') ?>

    <?php // echo $form->field($model, 'REGISTRAR_TITLE') ?>

    <?php // echo $form->field($model, 'REGISTRAR') ?>

    <?php // echo $form->field($model, 'PC_NO') ?>

    <?php // echo $form->field($model, 'RPC_NO') ?>

    <?php // echo $form->field($model, 'RPC_SERIAL_NO') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
