<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Productostbl */

$this->title = 'Create Productostbl';
$this->params['breadcrumbs'][] = ['label' => 'Productostbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productostbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
