<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitCar */

$this->title = 'Create Permit Car';
$this->params['breadcrumbs'][] = ['label' => 'Permit Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-car-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'province_th' => [],
        'province_na' => [],
        'border_th' => [],
        'initialPreview' => [],
        'initialPreviewConfig' => [],
    ])
    ?>

</div>