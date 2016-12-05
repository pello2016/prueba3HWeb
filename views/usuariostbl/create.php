<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */

$this->title = 'Registrar Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuariostbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
