<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;

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

    <!-- Este codigo se encarga de recorrer (si existen) mensajes, que podrian mostrar: Errores,informacion,o mensaje de exito
         Estos mensajes son cargados desde el controlador, y se recuperan aqui. -->
    <?php
    foreach (\Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([ 'options' => [ 'class' => 'alert-' . $key,], 'body' => $message,]);
    }
    ?>

    <p>
        <!--en la vista de detalles, se agrega un boton valorar que toma el id de la receta y la utiliza para  
            mostrar datos de la misma en la vista de valorar. aqui, se ingresan los datos y se guarda en bd -->
        <?= Html::a('Valorar', ['puntuaciontbl/create', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?php
        //se rescata la id de la receta.
        $recetaId = $model->id;
        //Verifica si el visitante es dueño de la receta
        if ($this->context->isOwner($recetaId, Yii::$app->user->identity->id)) 
                {
            //si es dueño de la receta se muestran los botones "modificar" y "eliminar".
            ?>
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

            <?php
        }//fin del if (es dueño?) 
        //si no es dueño, solo tendra la opcion de valorar.
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
$model2Array = $this->context->getIngredientes($model->id)
?>

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
