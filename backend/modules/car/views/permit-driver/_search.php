<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitDriverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-driver-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'CAR_ID') ?>

    <?= $form->field($model, 'REF_NUMBER') ?>

    <?= $form->field($model, 'DRIVER_TITLE') ?>

    <?= $form->field($model, 'DRIVER_FNME') ?>

    <?php // echo $form->field($model, 'DRIVER_MNME') ?>

    <?php // echo $form->field($model, 'DRIVER_LNME') ?>

    <?php // echo $form->field($model, 'PSLNUM') ?>

    <?php // echo $form->field($model, 'PASPOTTYP') ?>

    <?php // echo $form->field($model, 'PASPOTNUM') ?>

    <?php // echo $form->field($model, 'PASPOT_ISSUE') ?>

    <?php // echo $form->field($model, 'PASPOT_EXP') ?>

    <?php // echo $form->field($model, 'DRIVER_LICENSE_TYPE') ?>

    <?php // echo $form->field($model, 'DRIVER_LICENSE_NO') ?>

    <?php // echo $form->field($model, 'LICENSE_ISSUE') ?>

    <?php // echo $form->field($model, 'LICENSE_EXP') ?>

    <?php // echo $form->field($model, 'LICENSE_DLT_OfFICE') ?>

    <?php // echo $form->field($model, 'LICENSE_BR_CODE') ?>

    <?php // echo $form->field($model, 'ADDR') ?>

    <?php // echo $form->field($model, 'TUMBON_ID') ?>

    <?php // echo $form->field($model, 'AMPHUR_ID') ?>

    <?php // echo $form->field($model, 'PROVINCE_ID') ?>

    <?php // echo $form->field($model, 'POSCDE') ?>

    <?php // echo $form->field($model, 'ICC') ?>

    <?php // echo $form->field($model, 'DLT_APR_ID') ?>

    <?php // echo $form->field($model, 'DLT_APR_DTE') ?>

    <?php // echo $form->field($model, 'DLT_APR_STS') ?>

    <?php // echo $form->field($model, 'DLT_APR_DSC') ?>

    <?php // echo $form->field($model, 'ATTACHFILE_PASSPORT') ?>

    <?php // echo $form->field($model, 'ATTACHFILE_DRIVERLC') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
