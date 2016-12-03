<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Recetastbl */

$this->title = 'Create Recetastbl';
$this->params['breadcrumbs'][] = ['label' => 'Recetastbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetastbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
