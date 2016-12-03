<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PuntuaciontblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puntuaciontbls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntuaciontbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Puntuaciontbl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'valoracion',
            'usuariostbl_id',
            'recetastbl_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
