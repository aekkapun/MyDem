<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitOwner */

$this->title = 'Update Permit Owner: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Permit Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permit-owner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
