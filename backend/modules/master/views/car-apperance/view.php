<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\CarApperance */
?>
<div class="car-apperance-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'CAR_APPEAR_ID',
            'CAR_APPEAR',
            'CAR_APPEAR_EN',
            'STATUS',
            'TYP',
        ],
    ]) ?>

</div>
