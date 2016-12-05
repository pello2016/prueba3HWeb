<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Recetastbl */

$this->title = 'Modificar Receta: ' . $model->receta;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Recetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->receta, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="recetastbl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
