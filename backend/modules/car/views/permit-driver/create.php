<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitDriver */

$this->title = 'Create Permit Driver';
$this->params['breadcrumbs'][] = ['label' => 'Permit Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-driver-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
