<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\VehicleMode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-mode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TSPMDE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TSPMDE_EN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
