<?php
/* @var $this yii\web\View */
use 
yii\widgets\DetailView;

$this->title = 'Certificate Of Customary Inbound Vehicle Registion';


$this->params['breadcrumbs'][] = ['label' => 'Permit Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Collapsible Group Item #1
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?=
                    DetailView::widget([
                        'model' => $modelRequest,
                        'attributes' => [
                            'ID',
                            'OPERATE_TYPE',
                            'REQ_REF',
                            'ROUTE_PROVINCE',
                            'ROUTE_BODER_POINT',
                            'ROUTE_DETAIL',
//                            'DLT_OFFICE',
//                            'DLT_BRANCH',
//                            'STATUS',
//                            'CREATE_DTE',
//                            'CREATE_BY',
//                            'UPDATE_DTE',
//                            'UPDATE_BY',
                        ],
                    ])
                    ?>  
                </div>
            </div>
        </div>

    </div>
</div>
