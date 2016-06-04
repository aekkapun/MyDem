<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\master\models\Country */
?>
<div class="country-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'COUNTRY_ID',
            'COUNTRY_CODE',
            'COUNTRY_DESC',
            'COUNTRY_DESC_EN',
            'COUNTRY_INGENEVA',
            'CUSTOMS_CODE',
            'COUNTRY_ ABB',
            'STATUS',
        ],
    ]) ?>

</div>
