<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\car\models\PermitInsulance */

$this->title = 'Create Permit Insulance';
$this->params['breadcrumbs'][] = ['label' => 'Permit Insulances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-insulance-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
