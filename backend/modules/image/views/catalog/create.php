<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\image\models\CatalogOption */

$this->title = 'Customary Inbound Vehicle Registion.';
$this->params['breadcrumbs'][] = ['label' => 'Catalog Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelCatalogOption' => $modelCatalogOption,
        'modelsOptionValue' => (empty($modelsOptionValue)) ? [new OptionValue] : $modelsOptionValue
    ]) ?>

</div>
