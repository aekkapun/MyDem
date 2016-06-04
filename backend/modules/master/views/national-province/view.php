<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\NationalProvince */
?>
<div class="national-province-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'prv_name_th',
            'prv_name_en',
            'prv_name_en_abb',
            'country_code',
        ],
    ]) ?>

</div>
