<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitDriver */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-driver-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'CAR_ID',
            'REF_NUMBER',
            'DRIVER_TITLE',
            'DRIVER_FNME',
            'DRIVER_MNME',
            'DRIVER_LNME',
            'PSLNUM',
            'PASPOTTYP',
            'PASPOTNUM',
            'PASPOT_ISSUE',
            'PASPOT_EXP',
            'DRIVER_LICENSE_TYPE',
            'DRIVER_LICENSE_NO',
            'LICENSE_ISSUE',
            'LICENSE_EXP',
            'LICENSE_DLT_OfFICE',
            'LICENSE_BR_CODE',
            'ADDR',
            'TUMBON_ID',
            'AMPHUR_ID',
            'PROVINCE_ID',
            'POSCDE',
            'ICC',
            'DLT_APR_ID',
            'DLT_APR_DTE',
            'DLT_APR_STS',
            'DLT_APR_DSC',
            'ATTACHFILE_PASSPORT',
            'ATTACHFILE_DRIVERLC',
        ],
    ]) ?>

</div>
