<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitOwnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-owner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'OWNER_TITLE') ?>

    <?= $form->field($model, 'OWNER_FNME') ?>

    <?= $form->field($model, 'OWNER_MNME') ?>

    <?= $form->field($model, 'OWNER_LNME') ?>

    <?php // echo $form->field($model, 'OWNER_AGE') ?>

    <?php // echo $form->field($model, 'PSLNUM') ?>

    <?php // echo $form->field($model, 'PASPOTTYP') ?>

    <?php // echo $form->field($model, 'PASPOTNUM') ?>

    <?php // echo $form->field($model, 'PASPOT_ISSUE') ?>

    <?php // echo $form->field($model, 'PASPOT_EXP') ?>

    <?php // echo $form->field($model, 'TELEPHONE') ?>

    <?php // echo $form->field($model, 'ADDR') ?>

    <?php // echo $form->field($model, 'TUMBON_ID') ?>

    <?php // echo $form->field($model, 'AMPHUR_ID') ?>

    <?php // echo $form->field($model, 'PROVINCE_ID') ?>

    <?php // echo $form->field($model, 'POSCDE') ?>

    <?php // echo $form->field($model, 'ICC') ?>

    <?php // echo $form->field($model, 'ATTRACT_FILE') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'REQ_REF') ?>

    <?php // echo $form->field($model, 'REQ_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
