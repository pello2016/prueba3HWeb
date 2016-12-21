<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
    
    <div>
        <a class="btn btn-default" href="../web/index.php">Volver al Inicio &raquo;</a>
    </div>
</div>
