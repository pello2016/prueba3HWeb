<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecetastblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Recetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetastbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Nueva Receta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
    //Esto se usa para indicar que se usara Pjax (AJAX)
    Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'receta',
            'descripcion',
            // 'preparacion',
            'usuariostbl.nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    //Esto se usa para indicar el fin del uso de Pjax (AJAX)
    Pjax::end(); ?>
    <div>
        <a class="btn btn-default" href="../web/index.php">Volver al Inicio &raquo;</a>
    </div>
</div>
