<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\VehicleMode */
?>
<div class="vehicle-mode-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'TSPMDE',
            'TSPMDE_EN',
            'STATUS',
        ],
    ]) ?>

</div>
