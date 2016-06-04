<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\Title */
?>
<div class="title-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TITLE_ID',
            'TITLE_TH',
            'TITLE_EN',
            'STATUS',
        ],
    ]) ?>

</div>
