<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Recetasproducto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recetasproducto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recetastbl_id')->textInput() ?>

    <?= $form->field($model, 'productostbl_id')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'unidad')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
