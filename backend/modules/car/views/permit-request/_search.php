<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'OPERATE_TYPE') ?>

    <?= $form->field($model, 'REQ_REF') ?>

    <?= $form->field($model, 'ROUTE_PROVINCE') ?>

    <?= $form->field($model, 'ROUTE_BODER_POINT') ?>

    <?php // echo $form->field($model, 'ROUTE_DETAIL') ?>

    <?php // echo $form->field($model, 'DLT_OFFICE') ?>

    <?php // echo $form->field($model, 'DLT_BRANCH') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'CREATE_DTE') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_DTE') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
