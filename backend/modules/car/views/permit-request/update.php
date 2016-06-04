<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRequest */

$this->title = 'Update Permit Request: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permit-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelOwner' => $modelOwner,
        'province_th' => $province_th,
        'border_th' => $border_th,
        'province_na' => $province_na,
    ])
    ?>

</div>
