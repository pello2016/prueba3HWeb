<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */

$this->title = 'Cambiar Mi Clave';
$this->params['breadcrumbs'][] = ['label' => 'Editar Mis Datos', 'url' => ['editself', 'id' => Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-editselfpass">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>
    
</div>
