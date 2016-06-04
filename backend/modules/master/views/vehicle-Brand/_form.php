<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\VehicleBrand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'VHCBANCDE')->textInput() ?>

    <?= $form->field($model, 'VHCBANNME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
