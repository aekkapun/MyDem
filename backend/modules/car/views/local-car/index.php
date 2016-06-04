<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitCar */

$this->title = 'ขึ้นทะเบียนรถประจำถิ่น';
$this->params['breadcrumbs'][] = ['label' => 'Permit Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-car-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelVehicle' => $modelVehicle,
        'province_th' => [],
        'province_na' => [],
        'border_th' => [],
        'initialPreview' => [],
        'initialPreviewConfig' => [],
    ])
    ?>

</div>
