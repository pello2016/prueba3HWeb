<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */

$this->title = 'Editar Mis Datos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-editself">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Cambiar Clave', ['editselfpass', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-success']) ?>
    <div class="row"><div class="col-lg-12"><br></div></div>
    
    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
