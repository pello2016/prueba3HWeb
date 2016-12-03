<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Puntuaciontbl */

$this->title = 'Create Puntuaciontbl';
$this->params['breadcrumbs'][] = ['label' => 'Puntuaciontbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntuaciontbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
