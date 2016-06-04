<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\Color */
?>
<div class="color-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'color',
            'color_code',
        ],
    ]) ?>

</div>
