<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecetasproductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recetasproducto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'recetastbl_id') ?>

    <?= $form->field($model, 'productostbl_id') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'unidad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
