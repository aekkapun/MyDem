<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitOwner */

$this->title = 'เลขที่คำขอเลขที่ : ' . $model->REQ_REF;
$this->params['breadcrumbs'][] = ['label' => 'Permit Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>'คำขอเลขที่ : '. $model->REQ_REF, 'url' => ['view', 'id' => $model->ID]];;
$this->params['breadcrumbs'][] = 'อัพเดท';
?>
<div class="permit-owner-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelRequest' => $modelRequest,
        'province_th' => $province_th,
        'province_na' => $province_na,
        'border_th' => $border_th
    ])
    ?>

</div>
