<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRegister */

$this->title = 'Update Permit Register: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permit-register-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
    'model' => $model,
    'initialPreview' => $initialPreview,
    'initialPreviewConfig' => $initialPreviewConfig,
    'province_th' => [],
    'province_na' => [],
    'border_th' => []
    ])
    ?>

</div>
