<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitInsulance */

$this->title = 'Update Permit Insulance: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Insulances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permit-insulance-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
