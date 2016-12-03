<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariostblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuariostbls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuariostbl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usuariostbl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'password',
            'nombre',
            'apellido',
            // 'email:email',
            // 'rolestbl_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
