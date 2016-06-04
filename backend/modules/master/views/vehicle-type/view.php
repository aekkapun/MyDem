<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\VehicleType */
?>
<div class="vehicle-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'VHCTYP',
            'TYPNME',
            'TSPMDE',
        ],
    ]) ?>

</div>
