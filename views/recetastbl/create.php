<?php

use yii\helpers\Html;
use app\models\Productostbl;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Recetastbl */

$this->title = 'Crear Receta';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Recetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetastbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>

<script src="/prueba3hweb/web/scripts/funciones.js" type="text/javascript"></script>