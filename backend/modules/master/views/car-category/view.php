<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\CarCategory */
?>
<div class="car-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CAR_CATE_ID',
            'CAR_CATE_NAME',
            'CAR_CATE_NAME_EN',
            'STATUS',
        ],
    ]) ?>

</div>
