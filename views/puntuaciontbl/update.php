<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Puntuaciontbl */
/* @var $model2 app\models\Recetastbl */

$this->title = 'Update Puntuaciontbl: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Puntuaciontbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puntuaciontbl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'usuarios' => $usuarios,
        'recetas' => $recetas
    ]) ?>

</div>
