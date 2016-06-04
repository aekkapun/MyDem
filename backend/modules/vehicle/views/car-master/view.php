<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\gallery\Gallery;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\grid\GridViewAsset;
use backend\modules\master\models\Country;
use yii\widgets\Pjax;
use kartik\widgets\Spinner;
use demogorgorn\ajax\AjaxSubmitButton;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$tab = Yii::$app->getRequest()->getQueryParam('tab_id');

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\CarMaster */

$this->params['breadcrumbs'][] = ['label' => 'Car Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-master-view">
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
    <style>
        .nav-tabs-justified > .active > a, .nav-tabs-justified > .active > a:hover, .nav-tabs-justified > .active > a:focus {
            background: #701980 none repeat scroll 0 0;
            color:#fff;
            border: 1px solid #ddd;
        }
    </style>
    <?php
    Modal::begin([
        'id' => 'myModal',
        'header' => '<h4 class="modal-title fa fa-th-large ">...</h4>',
        'size' => 'modal-lg',
    ]);

    echo '...';

    Modal::end();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a class="fa fa-eye" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    ข้อมูลรถ
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
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
                        'colorName',
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
                        ['attribute' => 'ATTACH_FILE', 'value' => $model->listDownloadFiles('ATTACH_FILE'), 'format' => 'html'],
                    ],
                ])
                ?>

            </div>
        </div>
    </div>
</div>
<div class="tabbable">
    <ul class="nav nav-tabs-justified nav-justified">
        <li role="presentation"   >
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-user-secret"></span>เจ้าของรถ</a>
        </li>
        <li role="presentation" >
            <a href="#driver" aria-controls="driver" role="tab" data-toggle="tab"><i class="fa fa-truck" aria-hidden="true"></i>
                คนขับรถ</a>
        </li>
        <li role="presentation" >
            <a href="#insulance" aria-controls="insulance" role="tab" data-toggle="tab"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                ข้อมูล กรมธรรภ์</a>
        </li>
        <li role="presentation">
            <a href="#photo" aria-controls="photo" role="tab" data-toggle="tab"><i class="fa fa-photo" aria-hidden="true"></i>
                รูปภาพรถ</a>
        </li>
    </ul>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="fa fa-car"></span> ข้อมูลรถ</div>
            <div class="panel-body">
                <p class="pull-right">
                    <?=
                    Html::a(' เพิ่มข้อมูลเจ้าของรถ', ['/vehicle/permit-owner/create-ajax', 'id' => $model->ID], [
                        'class' => ' btn btn-primary fa fa-plus',
                        'data-toggle' => "modal",
                        'data-target' => "#myModal",
                        'data-title' => " เพิ่มข้อมูล เจ้าของรถ",
                    ]);
                    ?>
                </p>
                <div class="clearfix"></div>
                <?=
                GridView::widget([
                    'dataProvider' => $modelsOwner,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'ID',
                        'OWNER_TITLE',
                        'OWNER_FNME',
                        // 'OWNER_MNME',
                        'OWNER_LNME',
                        // 'OWNER_AGE',
                        // 'PSLNUM',
                        // 'PASPOTTYP',
                        // 'PASPOTNUM',
                        // 'PASPOT_ISSUE',
                        // 'PASPOT_EXP',
                        // 'TELEPHONE',
                        // 'ADDR',
                        // 'TUMBON_ID',
                        // 'AMPHUR_ID',
                        // 'PROVINCE_ID',
                        // 'POSCDE',
                        // 'ICC',
                        //'ATTRACT_FILE:ntext',
                        [
                            'header' => 'File',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a('<i class="fa fa-credit-card-alt" aria-hidden="true"></i>', ['/vehicle/permit-owner/file-ajax', 'id' => $data->ID], [
                                            'data-toggle' => "modal",
                                            'data-target' => "#myModal",
                                            'data-title' => "เอกสารการจดทะเบียน",
                                ]);
                            }
                                ],
                                [
                                    'label' => 'เอกสารแนบ',
                                    'format' => 'raw',
                                    'value' => function($data) {
                                        $url = Url::to(['/vehicle/permit-owner/json', 'id' => $data->ID]);
                                        return Html::a('<i class="fa fa-paperclip" aria-hidden="true"></i> attachment', $url, ['title' => 'Go', 'target' => '_blank']);
                                    }
                                        ],
                                        // 'CREATE_AT',
                                        // 'UPDATE_AT',
                                        // 'CREATE_BY',
                                        // 'UPDATE_BY',
                                        // 'REQ_REF',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'buttonOptions' => ['class' => 'btn btn-default'],
                                            'template' => '<div class="btn-group btn-group-sm text-center" role="group">{copy} {view} {update} {delete} </div>',
                                            'options' => ['style' => 'width:150px;'],
                                            'buttons' => [
                                                'view' => 'actionViewo',
                                                'update' => 'actionUpdateo',
                                                'delete' => 'actionDeleteo',
                                            ]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="driver">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-user-secret" aria-hidden="true"></i>
                                คนขับรถ</div>
                            <div class="panel-body">
                                <p class="pull-right">
                                    <?=
                                    Html::a(' เพิ่มข้อมูล คนขับรถ', ['/vehicle/permit-driver/create-ajax', 'id' => $model->ID], [
                                        'class' => ' btn btn-primary fa fa-truck',
                                        'data-toggle' => "modal",
                                        'data-target' => "#myModal",
                                        'data-title' => " เพิ่มข้อมูล คนขับรถ",
                                    ]);
                                    ?>
                                </p>
                                <div class="clearfix"></div>
                                <?=
                                GridView::widget([
                                    'dataProvider' => $modelsDriver,
                                    //'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        'CAR_ID',
                                        //'REF_NUMBER',
                                        'DRIVER_TITLE',
                                        'DRIVER_FNME',
                                        // 'DRIVER_MNME',
                                        'DRIVER_LNME',
                                        // 'PSLNUM',
                                        // 'PASPOTTYP',
                                        // 'PASPOTNUM',
                                        'PASPOT_ISSUE',
                                        'PASPOT_EXP',
                                        [
                                            'label' => '',
                                            'format' => 'raw',
                                            'value' => function($data) {
                                                $url = Url::to(['/vehicle/permit-driver/json-drl', 'id' => $data->ID]);
                                                return Html::a('<i class="fa fa-credit-card-alt" aria-hidden="true"></i> ', $url, ['title' => 'Driver License', 'target' => '_blank']);
                                            }
                                                ],
                                                [
                                                    'label' => '',
                                                    'format' => 'raw',
                                                    'value' => function($data) {
                                                        $url = Url::to(['/vehicle/permit-driver/json', 'id' => $data->ID]);
                                                        return Html::a('<i class="fa fa-book" aria-hidden="true"></i> ', $url, ['title' => 'Passport', 'target' => '_blank']);
                                                    }
                                                        ],
                                                        [
                                                            'class' => 'yii\grid\ActionColumn',
                                                            'buttonOptions' => ['class' => 'btn btn-default'],
                                                            'template' => '<div class="btn-group btn-group-sm text-center" role="group">{copy} {view} {update} {delete} </div>',
                                                            'options' => ['style' => 'width:150px;'],
                                                            'buttons' => [
                                                                'view' => 'actionViewd',
                                                                'update' => 'actionUpdated',
                                                                'delete' => 'actionDeleted',
                                                            ]
                                                        ],
                                                    ],
                                                ]);
                                                ?>
                                            </div>
                                        </div><!-- Model DRIVER -->
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="insulance">
                                        <div class="AccessPoint">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading"> 
                                                    <i class="fa fa-file-o" aria-hidden="true"></i>
                                                    ข้อมูล กรมธรรม์
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="panel-body">
                                                    <p class="pull-right">
                                                        <?=
                                                        Html::a(' เพิ่มข้อมูล กรมธรรม์', ['/vehicle/permit-insulance/create-ajax', 'id' => $model->ID], [
                                                            'class' => ' btn btn-primary fa fa-newpaper',
                                                            'data-toggle' => "modal",
                                                            'data-target' => "#myModal",
                                                            'data-title' => " เพิ่มข้อมูล กรมธรรม์",
                                                        ]);
                                                        ?>
                                                    </p>
                                                    <br/>
                                                    <?php
                                                    echo GridView::widget([
                                                        'dataProvider' => $modelsInsulance,
                                                        //'filterModel' => $searchModel,
                                                        'layout' => "{summary}\n{items}\n{pager}",
                                                        'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                            'INSURANCE_CMPNME',
                                                            'INSURANCE_NO',
                                                            'INSURANCE_EXP',
                                                            //'INSURANCE_FILE:ntext',
                                                            [
                                                                'label' => 'เอกสารแนบ',
                                                                'format' => 'raw',
                                                                'value' => function($data) {
                                                                    $url = Url::to(['/vehicle/permit-insulance/json', 'id' => $data->ID]);
                                                                    return Html::a('<i class="fa fa-paperclip" aria-hidden="true"></i> attachment', $url, ['title' => 'Go', 'target' => '_blank']);
                                                                }
                                                                    ],
                                                                    [
                                                                        'class' => 'yii\grid\ActionColumn',
                                                                        'buttonOptions' => ['class' => 'btn btn-default'],
                                                                        'template' => '<div class="btn-group btn-group-sm text-center" role="group">{copy} {view} {update} {delete} </div>',
                                                                        'options' => ['style' => 'width:150px;'],
                                                                        'buttons' => [
                                                                            'view' => 'actionViewi',
                                                                            'update' => 'actionUpdatei',
                                                                            'delete' => 'actionDeletei',
                                                                        ]
                                                                    ],
                                                                ],
                                                            ]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="photo">
                                                <div class="AccessPoint">
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading"> 
                                                            <i class="fa fa-photo" aria-hidden="true"></i>
                                                            รูปภาพรถ
                                                        </div>
                                                        <div class="panel-body">
                                                            <?= Gallery::widget(['items' => $model->getThumbnails($model->IMAGE_REF, $model->getAttributeLabel('IMAGE_REF'))]); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php Pjax::begin(); ?>
                                            <?= Html::beginForm(['/vehicle/car-master/view', 'id' => $model->ID], 'post', ['data-pjax' => 0, 'class' => 'form-inline']); ?>
                                            <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
                                            <?= Html::submitButton('Hash String', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
                                            <?= Html::endForm() ?>
                                            <h3><?= $stringHash ?></h3>
                                            <?php Pjax::end(); ?>

                                            <hr />
                                        </div>


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


                                        <!-- functions for grid buttons actions -->
                                        <?php

                                        // Owner
                                        function actionViewo($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-owner/view-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                                        'class' => 'actionView',
                                                        //'data-pjax' => '0',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#myModal',
                                                        'data-title' => " ข้อมูล เจ้าของรถ",
                                                        'data-pjax' => '0',
                                            ]);
                                        }

                                        function actionUpdateo($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-owner/update-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                        'class' => 'actionUpdate',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#myModal',
                                                        'data-title' => " อัพเดทข้อมูล เจ้าของรถ",
                                                        'data-pjax' => '0',
                                            ]);
                                        }

                                        function actionDeleteo($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-owner/delete-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                        'class' => 'actionDelete',
                                                        'data-pjax' => '0',
                                                        'data-method' => 'post',
                                                        'data-title' => " ลบ เจ้าของรถ",
                                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                                        'data-method' => 'post',
                                            ]);
                                        }

                                        // Driver
                                        function actionUpdated($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-driver/update-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                        'class' => 'actionUpdate',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#myModal',
                                                        'data-title' => " อัพเดทข้อมูล คนขับรถ",
                                                        'data-pjax' => '0',
                                            ]);
                                        }

                                        function actionDeleted($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-driver/delete-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                        'class' => 'actionDelete',
                                                        'data-pjax' => '0',
                                                        'data-method' => 'post',
                                                        'data-title' => " ลบ คนขับรถ",
                                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                                        'data-method' => 'post',
                                            ]);
                                        }

                                        function actionViewd($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-driver/view-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                                        'class' => 'actionView',
                                                        //'data-pjax' => '0',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#myModal',
                                                        'data-title' => " ข้อมูล คนขับรถ",
                                                        'data-pjax' => '0',
                                            ]);
                                        }

                                        // Insulance
                                        function actionUpdatei($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-insulance/update-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                        'class' => 'actionUpdate',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#myModal',
                                                        'data-title' => " อัพเดทข้อมูล กรมธรรม์",
                                                        'data-pjax' => '0',
                                            ]);
                                        }

                                        function actionDeletei($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-insulance/delete-ajax', 'id' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                        'class' => 'actionDelete',
                                                        'data-pjax' => '0',
                                                        'data-method' => 'post',
                                                        'data-title' => " Del insulance",
                                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                                        'data-method' => 'post',
                                            ]);
                                        }

                                        function actionViewi($url, $model, $key) {
                                            $url = Url::to(['/vehicle/permit-insulance/view-ajax', 'id' => $key]);
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
$script = <<< JS
    $(function() {
        //save the latest tab (http://stackoverflow.com/a/18845441)
        $('a[data-toggle="tab"]').on('click', function (e) {
            localStorage.setItem('lastTab', $(e.target).attr('href'));
        });

        //go to the latest tab, if it exists:
        var lastTab = localStorage.getItem('lastTab');

        if (lastTab) {
            $('a[href="'+lastTab+'"]').click();
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>