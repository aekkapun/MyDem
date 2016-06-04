<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vehicle\models\CarMaster */

$this->title = 'Create Car Master';
$this->params['breadcrumbs'][] = ['label' => 'Car Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-master-create">


    <?=
    $this->render('_form', [
        'model' => $model,
        'modelRequest' => $modelRequest,
        'initialPreview' => [],
        'initialPreviewConfig' => [],
        'province_th' => [],
        'province_na' => [],
        'border_th' => []
    ])
    ?>

</div>
