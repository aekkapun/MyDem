<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitDriver */

$this->title = 'Update Permit Driver: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permit-driver-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
