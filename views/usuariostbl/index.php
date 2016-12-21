<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariostblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuariostbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
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
            'username',
            // 'password',
            // 'authKey',
            'nombre',
            'apellido',
            // 'email:email',
            'rolestbl.rol',

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
