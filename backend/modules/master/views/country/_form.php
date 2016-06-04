<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'COUNTRY_CODE')->textInput() ?>

    <?= $form->field($model, 'COUNTRY_DESC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COUNTRY_DESC_EN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COUNTRY_INGENEVA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CUSTOMS_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
