<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\car\models\PermitRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permit Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permit Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'OPERATE_TYPE',
            'REQ_REF',
            'ROUTE_PROVINCE',
            'ROUTE_BODER_POINT',
            // 'ROUTE_DETAIL',
            // 'DLT_OFFICE',
            // 'DLT_BRANCH',
            // 'STATUS',
            // 'CREATE_DTE',
            // 'CREATE_BY',
            // 'UPDATE_DTE',
            // 'UPDATE_BY',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
