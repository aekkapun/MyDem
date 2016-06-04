<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoLibrary */

$this->title = 'Vehicle Register';
$this->params['breadcrumbs'][] = ['label' => 'Photo Libraries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-library-create">
    <?=
    $this->render('_form', [
        'model' => $model,
        //'modelRequest' => $modelRequest,
        'initialPreview' => [],
        'initialPreviewConfig' => [],
        'province_th' => [],
        'province_na' => [],
        'border_th' => []
    ])
    ?>

</div>
