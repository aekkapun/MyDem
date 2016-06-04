<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vehicle\models\PermitOwnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permit Owners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-owner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permit Owner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ID',
            'OWNER_TITLE',
            'OWNER_FNME',
            'OWNER_MNME',
            'OWNER_LNME',
            // 'OWNER_AGE',
            // 'PSLNUM',
            // 'PASPOTTYP',
            // 'PASPOTNUM',
            // 'PASPOT_ISSUE',
            // 'PASPOT_EXP',
            // 'EMAIL:email',
            // 'TELEPHONE',
            // 'ADDR',
            // 'TUMBON_ID',
            // 'AMPHUR_ID',
            // 'PROVINCE_ID',
            // 'POSCDE',
            // 'ICC',
            //'ATTRACT_FILE:ntext',
            [
                'label' => 'เอกสารแนบ',
                'format' => 'raw',
                'value' => function($data) {
                    $url = Url::to(['/vehicle/permit-owner/json', 'id' => $data->ID]);
                    return Html::a('<i class="fa fa-paperclip" aria-hidden="true"></i> attachment', $url, ['title' => 'Go', 'target' => '_blank']);
                }
                    ],
                    // 'CAR_ID',
                    // 'CREATE_AT',
                    // 'UPDATE_AT',
                    // 'CREATE_BY',
                    // 'UPDATE_BY',
                    // 'REQ_REF',
                    // 'REQ_ID',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
</div>