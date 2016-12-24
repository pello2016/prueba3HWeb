<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductostblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productostbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        //verifica si el visitante es adminsitrador o no.
        if (Yii::$app->user->identity->rolestbl->rol == "administrador") {
        ?>
        <!-- Esta opcion solo esta disponible para los adminstradores. -->
        <?= Html::a('Agregar Nuevo Producto', ['create'], ['class' => 'btn btn-success']) ?>
        <?php 
        } 
        ?>
    </p>
    <?php
    //Esto se usa para indicar que se usara Pjax (AJAX)
    Pjax::begin();
    ?>

    <!-- Este codigo se encarga de recorrer (si existen) mensajes, que podrian mostrar: Errores,informacion,o mensaje de exito
         Estos mensajes son cargados desde el controlador, y se recuperan aqui. -->
    <?php
    foreach (\Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([ 'options' => [ 'class' => 'alert-' . $key,], 'body' => $message,]);
    }
    ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'producto',
            'descripcion',
            ['class' => 'yii\grid\ActionColumn',
                //esto permite implementar condiciones de visibilidad a los botones "view","update" y "delete"
                //para lo cual usa una funcion dentro de "RecetastblController"
                'visibleButtons' => [
                    'view' => true,
                    'update' => function () {
                        $admin = false;
                        if (Yii::$app->user->identity->rolestbl->rol == "administrador") {
                            $admin = true;
                        }
                        return $admin;
                    },
                    'delete' => function () {
                        $admin = false;
                        if (Yii::$app->user->identity->rolestbl->rol == "administrador") {
                            $admin = true;
                        }
                        return $admin;
                    },
                ]],
        ],
    ]);
    ?>
    <?php
    //Esto se usa para indicar el fin del uso de Pjax (AJAX)
    Pjax::end();
    ?>
    <div>
        <a class="btn btn-default" href="../web/index.php">Volver al Inicio &raquo;</a>
    </div>
</div>
