<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use yii\grid\GridView;
//use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Recetastbl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->receta;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Recetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetastbl-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'receta',
            'descripcion',
            'preparacion',
            'usuariostbl.nombre',
        ],
    ])
    ?>
    <hr>

    
    <?php 
    //Se llama al metodo que retorna todos los ingredientes para esta receta.
    $model2Array = $this->context->getIngredientes($model->id) ?>
    
    <!--Inicio Tabla ingredientes -->
    <table id="w1" class="table table-striped table-bordered detail-view" >
        <tbody>
            <?php
            $contador = 0;
            //se recorren ingredientes recibido, y por cada campo que contiene se genera una fila para la tabla
            //que los contendra.
            foreach ($model2Array as $model2) {
                $contador++;
                ?>
                <!--Inicio html -->
                <tr ><th style="width:36%">Ingrediente <?= $contador ?></th><td><?= $model2->productostbl->producto ?></td></tr>
                <tr ><th style="width:36%">Cantidad</th><td><?= $model2->cantidad ?></td></tr>
                <tr ><th style="width:36%">Unidad</th><td><?= $model2->unidad ?></td></tr> 
                <tr ><th style="width:36%"><hr></th><td><hr></td></tr> 
                <!--Fin html -->
                <?php
            }
            ?>
        </tbody>
    </table>
    <!--Fin Tabla ingredientes -->

</div>
