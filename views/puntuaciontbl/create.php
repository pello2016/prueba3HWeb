<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Puntuaciontbl */
/* @var $model2 app\models\Recetastbl */

//se modifico esta vista de tal forma que tanto el titulo como los breadcrumbs coincidan con la tabla de recetas
//de la cual provienen, asi, logra accederse al crear de la tabla de puntuaciones, se ingresan y guardan los datos
//en la bd, y luego redirige a la lista de recetas.
$this->title = 'Valorar Receta: ' . $model2->receta;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Recetas', 'url' => ['recetastbl/index']];
$this->params['breadcrumbs'][] = ['label' => $model2->receta, 'url' => ['recetastbl/view', 'id' => $model2->id]];
$this->params['breadcrumbs'][] = 'Valorar';
?>
<div class="puntuaciontbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- se reciben en la vista los elementos provenientes del controlador. asi, pueden ser utilizados dentro -->
    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'usuarios' => $usuarios,
        'recetas' => $recetas
    ]) ?>

</div>
