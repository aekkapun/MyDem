<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRegister */

$this->title = 'Create Permit Register';
$this->params['breadcrumbs'][] = ['label' => 'Permit Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-register-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
