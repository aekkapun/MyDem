<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRegister */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-register-view">

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
            'OPERATE_TYPE',
            'CAR_ID',
            'REF_REQ',
            'REF_SUCCESS',
            'LICENSE_NO',
            'REGISTER_DATE',
            'EXPIRE_DATE',
            'ROUTE_DETAIL',
            'DLT_OFFICE',
            'DLT_BRANCH',
            'REGISTRAR_TITLE',
            'REGISTRAR',
            'PC_NO',
            'RPC_NO',
            'RPC_SERIAL_NO',
            'CREATE_AT',
            'UPDATE_AT',
            'CREATE_BY',
            'UPDATE_BY',
        ],
    ]) ?>

</div>
