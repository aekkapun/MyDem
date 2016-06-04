<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitOwner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-owner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OWNER_TITLE')->textInput() ?>

    <?= $form->field($model, 'OWNER_FNME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OWNER_MNME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OWNER_LNME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OWNER_AGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PSLNUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASPOTTYP')->textInput() ?>

    <?= $form->field($model, 'PASPOTNUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASPOT_ISSUE')->textInput() ?>

    <?= $form->field($model, 'PASPOT_EXP')->textInput() ?>

    <?= $form->field($model, 'TELEPHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TUMBON_ID')->textInput() ?>

    <?= $form->field($model, 'AMPHUR_ID')->textInput() ?>

    <?= $form->field($model, 'PROVINCE_ID')->textInput() ?>

    <?= $form->field($model, 'POSCDE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ICC')->textInput() ?>

    <?= $form->field($model, 'ATTRACT_FILE')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput() ?>

    <?= $form->field($model, 'REQ_REF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REQ_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
