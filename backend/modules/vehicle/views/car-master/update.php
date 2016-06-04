<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\CarMaster */

$this->title = 'Update Car Master: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Car Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-master-update">


    <?=
    $this->render('_form', [
        'model' => $model,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig,
        'modelRequest' => $modelRequest,
        'province_th' => $province_th,
        'province_na' => $province_na,
        'border_th' => $border_th
    ])
    ?>

</div>
