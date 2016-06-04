<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitOwner */

$this->title = 'Update Permit Owner: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permit-owner-update">
    <div class="panel panel-primary">
        <div class="panel-heading">ข้อมูลเจ้าของรถ</div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
                'province_th' => [],
                'province_na' =>$province_na,
                'border_th' => []
            ])
            ?>
            <?php
            VarDumper::dump($province_na);
            ?>
        </div>
    </div>
    </div>
