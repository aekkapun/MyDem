<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitOwner */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-owner-view">

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
            'OWNER_TITLE',
            'OWNER_FNME',
            'OWNER_MNME',
            'OWNER_LNME',
            'OWNER_AGE',
            'PSLNUM',
            'PASPOTTYP',
            'PASPOTNUM',
            'PASPOT_ISSUE',
            'PASPOT_EXP',
            'TELEPHONE',
            'ADDR',
            'TUMBON_ID',
            'AMPHUR_ID',
            'PROVINCE_ID',
            'POSCDE',
            'ICC',
            'ATTRACT_FILE:ntext',
            'CREATE_AT',
            'UPDATE_AT',
            'CREATE_BY',
            'UPDATE_BY',
            'REQ_REF',
            'REQ_ID',
        ],
    ]) ?>

</div>
