<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rolestbl */

$this->title = 'Create Rolestbl';
$this->params['breadcrumbs'][] = ['label' => 'Rolestbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolestbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
