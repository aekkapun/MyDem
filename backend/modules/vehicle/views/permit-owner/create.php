<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitOwner */

$this->title = 'Create Permit Owner';
$this->params['breadcrumbs'][] = ['label' => 'Permit Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-owner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
