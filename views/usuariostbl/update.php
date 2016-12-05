<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */

$this->title = 'Modificar Usuario: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="usuariostbl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
