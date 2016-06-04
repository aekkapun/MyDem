<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\CustBorderPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cust-border-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BORDER_POINT_CODE')->textInput() ?>

    <?= $form->field($model, 'BORDER_POINT_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROVINCE_ID')->textInput() ?>

    <?= $form->field($model, 'PROVINCE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
