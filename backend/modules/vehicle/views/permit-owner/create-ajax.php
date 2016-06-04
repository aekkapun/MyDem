<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\PermitOwner */

$this->title = 'Create Permit Owner';
$this->params['breadcrumbs'][] = ['label' => 'Permit Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permit-owner-create">


    <?=
    $this->render('_form-ajax', [
        'model' => $model,
        'province_th' => [],
        'province_na' => [],
        'border_th' => []
    ])
    ?>

</div>
