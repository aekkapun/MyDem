<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\VehicleBrand */
?>
<div class="vehicle-brand-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'VHCBANCDE',
            'VHCBANNME',
            'STATUS',
        ],
    ]) ?>

</div>
