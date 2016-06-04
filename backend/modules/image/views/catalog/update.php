<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\image\models\CatalogOption */

$this->title = 'Update Catalog Option: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Catalog Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="catalog-option-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
