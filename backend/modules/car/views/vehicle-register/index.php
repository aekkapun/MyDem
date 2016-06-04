<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\car\models\PermitCarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permit Cars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-car-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permit Car', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'TSPMDE',
            'VHCLCN1',
            'VHCLCN2',
            'VHCPRV',
            // 'VHCCTY',
            // 'VHCVERNUM',
            // 'VHCBANCDE',
            // 'CARCATE',
            // 'VHCTYP',
            // 'CARAPPR',
            // 'VHCMDLCDE',
            // 'CORCDE',
            // 'VHCYER',
            // 'CHSNUM',
            // 'ENENUM',
            // 'CC',
            // 'HP',
            // 'KW',
            // 'ENG_TYP',
            // 'FUEL_TYP',
            // 'GPS',
            // 'VHCVAL',
            // 'WGT',
            // 'TOTAL_WGT',
            // 'TOTPSG',
            // 'REGIS_STATUS',
            // 'REF_SUCCESS',
            // 'REQ_REF',
            // 'ATTACH_FILE',
            'IMAGE_REF',
            // 'OWNER_ID',
            // 'CREATE_AT',
            // 'UPDATE_AT',
            // 'CREATE_BY',
            // 'UPDATE_BY',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
