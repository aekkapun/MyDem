<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vehicle\models\CarMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Car Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
    <?= Html::a('Create Car Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'ID',
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
            'REQ_REF',
            [
                'header' => 'File',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('<i class="fa fa-credit-card-alt" aria-hidden="true"></i>', ['file-ajax', 'id' => $data->ID], [
                                'data-toggle' => "modal",
                                'data-target' => "#myModal",
                                'data-title' => "เอกสารการจดทะเบียน",
                    ]);
                }
                    ],
                    //'IMAGE_REF',
                    // 'OWNER_ID',
                    // 'CREATE_AT',
                    // 'UPDATE_AT',
                    // 'CREATE_BY',
                    // 'UPDATE_BY',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
        <?php
        Modal::begin([
            'id' => 'myModal',
            'size' => 'modal-lg',
            'header' => '<h4 class="modal-title">...</h4>',
        ]);

        echo '...';

        Modal::end();
        ?>

        <?php
        $this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
        ?>