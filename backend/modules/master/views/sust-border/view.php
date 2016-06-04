<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\CustBorderPoint */
?>
<div class="cust-border-point-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'BORDER_POINT_CODE',
            'BORDER_POINT_NAME',
            'PROVINCE_ID',
            'PROVINCE_NAME',
            'STATUS',
        ],
    ]) ?>

</div>
