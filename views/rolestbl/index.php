<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolestblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rolestbls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolestbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rolestbl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'rol',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
