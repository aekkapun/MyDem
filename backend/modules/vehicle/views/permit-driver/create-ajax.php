<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitDriver */

$this->title = 'Create Permit Driver';
$this->params['breadcrumbs'][] = ['label' => 'Permit Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-driver-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
