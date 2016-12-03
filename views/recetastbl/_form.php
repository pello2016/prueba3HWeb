<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Recetastbl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recetastbl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'receta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preparacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuariostbl_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
