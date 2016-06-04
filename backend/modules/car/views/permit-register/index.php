<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\car\models\PermitRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permit Registers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-register-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permit Register', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'OPERATE_TYPE',
            'CAR_ID',
            'REF_REQ',
            'REF_SUCCESS',
            // 'LICENSE_NO',
            // 'REGISTER_DATE',
            // 'EXPIRE_DATE',
            // 'ROUTE_DETAIL',
            // 'DLT_OFFICE',
            // 'DLT_BRANCH',
            // 'REGISTRAR_TITLE',
            // 'REGISTRAR',
            // 'PC_NO',
            // 'RPC_NO',
            // 'RPC_SERIAL_NO',
            // 'CREATE_AT',
            // 'UPDATE_AT',
            // 'CREATE_BY',
            // 'UPDATE_BY',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
