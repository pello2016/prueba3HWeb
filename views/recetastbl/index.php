<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecetastblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Recetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetastbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- Este codigo se encarga de recorrer (si existen) mensajes, que podrian mostrar: Errores,informacion,o mensaje de exito
         Estos mensajes son cargados desde el controlador -->
    <?php
    foreach (\Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([ 'options' => [ 'class' => 'alert-' . $key,], 'body' => $message,]);
    }
    ?>

    <!-- La opcion de busqueda se ha quitado, ya que no se evalua en esta prueba.-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Nueva Receta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    //Esto se usa para indicar que se usara Pjax (AJAX)
    Pjax::begin();
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'receta',
            'descripcion',
            // 'preparacion',
            'usuariostbl.nombre',
            ['class' => 'yii\grid\ActionColumn',
                //esto permite implementar condiciones de visibilidad a los botones "view","update" y "delete"
                //para lo cual usa una funcion dentro de "RecetastblController"
                'visibleButtons' => [
                    'view' => true,
                    'update' => function ($model, $url, $key) { 
                        $recetaId = $model->id;
                        return $this->context->isOwner($recetaId, Yii::$app->user->identity->id);
                    },
                    'delete' => function ($model, $url, $key) {
                        $recetaId = $model->id;
                        return $this->context->isOwner($recetaId, \Yii::$app->user->identity->id);
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
