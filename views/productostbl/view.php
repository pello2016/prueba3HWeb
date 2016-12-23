<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Productostbl */

$this->title = $model->producto;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productostbl-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <!-- Este codigo se encarga de recorrer (si existen) mensajes, que podrian mostrar: Errores,informacion,o mensaje de exito
         Estos mensajes son cargados desde el controlador, y se recuperan aqui. -->
    <?php
    foreach (\Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([ 'options' => [ 'class' => 'alert-' . $key,], 'body' => $message,]);
    }
    ?>

    <p>
        <?php
        //verifica si el visitante es adminsitrador o no.
        if (Yii::$app->user->identity->rolestbl->rol == "administrador") {
            
        ?>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
        <?php 
        } //Fin if verifica rol
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'producto',
            'descripcion',
        ],
    ]) ?>

</div>
