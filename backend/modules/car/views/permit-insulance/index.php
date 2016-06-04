<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\car\models\PermitInsulanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permit Insulances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-insulance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Permit Insulance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ID',
            'INSURANCE_CMPNME',
            'INSURANCE_NO',
            'INSURANCE_EXP',
            'INSURANCE_FILE:ntext',
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{copy} {view} {update} {delete} </div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'view' => 'actionView',
                    'update' => 'actionUpdate',
                    'delete' => 'actionDelete',
                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
<?php

// Insulance
function actionUpdate($url, $model, $key) {
    $url = Url::to(['/car/permit-insulance/update', 'id' => $key]);
    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                'class' => 'actionUpdate',
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                'data-title' => " อัพเดทข้อมูล กรมธรรม์",
                'data-pjax' => '0',
    ]);
}

function actionDelete($url, $model, $key) {
    $url = Url::to(['/car/permit-insulance/delete-ajax', 'id' => $key]);
    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                'class' => 'actionDelete',
                'data-pjax' => '0',
                'data-method' => 'post',
                'data-title' => " Del insulance",
                'data-confirm' => 'Are you sure you want to delete this item?',
                'data-method' => 'post',
    ]);
}

function actionView($url, $model, $key) {
    $url = Url::to(['/car/permit-insulance/view', 'id' => $key]);
    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                'class' => 'actionView',
                //'data-pjax' => '0',
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                'data-title' => " ข้อมูล กรมธรรม์",
                'data-pjax' => '0',
    ]);
}
?>
    <?php
    Modal::begin([
        'id' => 'myModal',
        'header' => '<h4 class="modal-title fa fa-th-large ">...</h4>',
        'size' => 'modal-lg',
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
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-pulse\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
                                        ?>