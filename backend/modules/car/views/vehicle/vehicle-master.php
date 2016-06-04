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
    $this->render('_vehicle-master', [
        'model' => $model,
        'modelsDriver' => (empty($modelsDriver)) ? [new PermitDriver] : $modelsDriver,
        'modelsInsulance' => (empty($modelsInsulance)) ? [new PermitInsulance] : $modelsInsulance,
    ])
    ?>

</div>
