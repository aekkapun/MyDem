<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\gallery\Gallery;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitCar */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-car-view">

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
            'ID',
            'TSPMDE',
            'VHCLCN1',
            'VHCLCN2',
            'VHCPRV',
            'VHCCTY',
            'VHCVERNUM',
            'VHCBANCDE',
            'CARCATE',
            'VHCTYP',
            'CARAPPR',
            'VHCMDLCDE',
            'CORCDE',
            'VHCYER',
            'CHSNUM',
            'ENENUM',
            'CC',
            'HP',
            'KW',
            'ENG_TYP',
            'FUEL_TYP',
            'GPS',
            'VHCVAL',
            'WGT',
            'TOTAL_WGT',
            'TOTPSG',
            'REGIS_STATUS',
            'REF_SUCCESS',
            'REQ_REF',
            //'ATTACH_FILE',
            ['attribute' => 'ATTACH_FILE', 'value' => $model->listDownloadFiles('ATTACH_FILE'), 'format' => 'html'],
            'IMAGE_REF',
            'OWNER_ID',
            'CREATE_AT',
            'UPDATE_AT',
            'CREATE_BY',
            'UPDATE_BY',
        ],
    ])
    ?>

</div>
<div class="panel panel-default">
    <div class="panel-body">
<?= Gallery::widget(['items' => $model->getThumbnails($model->IMAGE_REF,$model->getAttributeLabel('IMAGE_REF'))]); ?>
    </div>
</div>
