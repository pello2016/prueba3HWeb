<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productostbl */

$this->title = 'Modificar Producto: ' . $model->producto;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->producto, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productostbl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
