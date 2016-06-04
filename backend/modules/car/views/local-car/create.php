<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitRequest */

$this->title = 'ขึ้นทะเบียนรถประจำถิ่น';
$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-request-create">


    <?=
    $this->render('_formone', [
        'model' => $model,
        'model' => $modelForm,
        'province_th' => [],
        'province_na' => [],
        'border_th'=>[]
    ])
    ?>

</div>
