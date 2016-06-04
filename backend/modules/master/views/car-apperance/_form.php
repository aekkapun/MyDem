<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\CarApperance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-apperance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CAR_APPEAR_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CAR_APPEAR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CAR_APPEAR_EN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'TYP')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
