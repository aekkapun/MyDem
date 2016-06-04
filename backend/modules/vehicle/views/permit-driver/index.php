<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vehicle\models\PermitDriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permit Drivers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-driver-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Permit Driver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ID',
            //'CAR_ID',
            //'REF_NUMBER',
            'DRIVER_TITLE',
            'DRIVER_FNME',
            // 'DRIVER_MNME',
            'DRIVER_LNME',
            // 'PSLNUM',
            // 'PASPOTTYP',
            'PASPOTNUM',
            'PASPOT_ISSUE',
            'PASPOT_EXP',
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
            [
                'header' => 'DRL',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('<i class="fa fa-credit-card-alt" aria-hidden="true"></i>', ['file-ajax', 'id' => $data->ID], [
                                'data-toggle' => "modal",
                                'data-target' => "#myModal",
                                'data-title' => "Driver License",
                    ]);
                }
                    ],
                    [
                        'header' => 'PSP',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a('<i class="fa fa-book"></i>', ['pass-ajax', 'id' => $data->ID], [
                                        'data-toggle' => "modal",
                                        'data-target' => "#myModal",
                                        'data-title' => "Passport ",
                            ]);
                        }
                            ],
                            // 'DLT_APR_ID',
                            // 'DLT_APR_DTE',
                            // 'DLT_APR_STS',
                            // 'DLT_APR_DSC',
                            // 'ATTACHFILE_DRIVERLC',
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