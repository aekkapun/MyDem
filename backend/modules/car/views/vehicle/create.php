<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitOwner */

$this->title = 'Customary Inbound Vehicle Registion.';
$this->params['breadcrumbs'][] = ['label' => 'Permit Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-owner-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelRequest' => $modelRequest,
        'province_th' => [],
        'province_na' => [],
        'border_th' => []
    ])
    ?>

</div>
