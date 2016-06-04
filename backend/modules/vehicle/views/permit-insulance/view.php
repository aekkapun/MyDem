<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitInsulance */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Insulances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-insulance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID',
            'INSURANCE_CMPNME',
            'INSURANCE_NO',
            'INSURANCE_EXP',
           // 'INSURANCE_FILE:ntext',
            [
                'attribute' => 'INSURANCE_FILE',
                'value' => $model->listDownloadFiles('INSURANCE_FILE'),
                'format' => 'html'
            ],
//    [
//    'format' => 'raw',
//    'attribute' => 'INSURANCE_FILE',
//    'value' => $model->getImage($model->ID)
//    ],
        ],
    ])
    ?>

</div>
