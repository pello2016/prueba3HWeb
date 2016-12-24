<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuariostbl-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        //verifica si el visitante es adminsitrador o no.
        if (Yii::$app->user->identity->rolestbl->rol == "administrador") {  
        ?>
        <!-- Esta opcion solo esta disponible para los adminstradores. -->
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de que desea borrar este Usuario?',
                'method' => 'post',
            ],
        ]) ?>
        <?php 
        } 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            // 'password',
            'nombre',
            'apellido',
            'email:email',
            'rolestbl.rol',
        ],
    ]) ?>

</div>
