<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRequest */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-request-view">

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
            'REQ_REF',
            'ROUTE_PROVINCE',
            'ROUTE_BODER_POINT',
            'ROUTE_DETAIL',
            'DLT_OFFICE',
            'DLT_BRANCH',
            'STATUS',
            'CREATE_DTE',
            'CREATE_BY',
            'UPDATE_DTE',
            'UPDATE_BY',
        ],
    ]) ?>

</div>
