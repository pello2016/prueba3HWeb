<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecetasproductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recetasproductos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetasproducto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Recetasproducto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'recetastbl_id',
            'productostbl_id',
            'cantidad',
            'unidad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
