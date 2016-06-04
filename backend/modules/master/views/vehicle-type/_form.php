<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\VehicleType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TYPNME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TSPMDE')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
