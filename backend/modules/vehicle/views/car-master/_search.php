<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\CarMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'TSPMDE') ?>

    <?= $form->field($model, 'VHCLCN1') ?>

    <?= $form->field($model, 'VHCLCN2') ?>

    <?= $form->field($model, 'VHCPRV') ?>

    <?php // echo $form->field($model, 'VHCCTY') ?>

    <?php // echo $form->field($model, 'VHCVERNUM') ?>

    <?php // echo $form->field($model, 'VHCBANCDE') ?>

    <?php // echo $form->field($model, 'CARCATE') ?>

    <?php // echo $form->field($model, 'VHCTYP') ?>

    <?php // echo $form->field($model, 'CARAPPR') ?>

    <?php // echo $form->field($model, 'VHCMDLCDE') ?>

    <?php // echo $form->field($model, 'CORCDE') ?>

    <?php // echo $form->field($model, 'VHCYER') ?>

    <?php // echo $form->field($model, 'CHSNUM') ?>

    <?php // echo $form->field($model, 'ENENUM') ?>

    <?php // echo $form->field($model, 'CC') ?>

    <?php // echo $form->field($model, 'HP') ?>

    <?php // echo $form->field($model, 'KW') ?>

    <?php // echo $form->field($model, 'ENG_TYP') ?>

    <?php // echo $form->field($model, 'FUEL_TYP') ?>

    <?php // echo $form->field($model, 'GPS') ?>

    <?php // echo $form->field($model, 'VHCVAL') ?>

    <?php // echo $form->field($model, 'WGT') ?>

    <?php // echo $form->field($model, 'TOTAL_WGT') ?>

    <?php // echo $form->field($model, 'TOTPSG') ?>

    <?php // echo $form->field($model, 'REGIS_STATUS') ?>

    <?php // echo $form->field($model, 'REF_SUCCESS') ?>

    <?php // echo $form->field($model, 'REQ_REF') ?>

    <?php // echo $form->field($model, 'ATTACH_FILE') ?>

    <?php // echo $form->field($model, 'IMAGE_REF') ?>

    <?php // echo $form->field($model, 'OWNER_ID') ?>

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
