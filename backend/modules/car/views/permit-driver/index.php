<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\car\models\PermitDriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permit Drivers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-driver-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permit Driver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'CAR_ID',
            'REF_NUMBER',
            'DRIVER_TITLE',
            'DRIVER_FNME',
            // 'DRIVER_MNME',
            // 'DRIVER_LNME',
            // 'PSLNUM',
            // 'PASPOTTYP',
            // 'PASPOTNUM',
            // 'PASPOT_ISSUE',
            // 'PASPOT_EXP',
            // 'DRIVER_LICENSE_TYPE',
            // 'DRIVER_LICENSE_NO',
            // 'LICENSE_ISSUE',
            // 'LICENSE_EXP',
            // 'LICENSE_DLT_OfFICE',
            // 'LICENSE_BR_CODE',
            // 'ADDR',
            // 'TUMBON_ID',
            // 'AMPHUR_ID',
            // 'PROVINCE_ID',
            // 'POSCDE',
            // 'ICC',
            // 'DLT_APR_ID',
            // 'DLT_APR_DTE',
            // 'DLT_APR_STS',
            // 'DLT_APR_DSC',
            // 'ATTACHFILE_PASSPORT',
            // 'ATTACHFILE_DRIVERLC',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
