<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Recetasproducto */

$this->title = 'Create Recetasproducto';
$this->params['breadcrumbs'][] = ['label' => 'Recetasproductos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetasproducto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
