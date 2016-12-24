<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-form2">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'password')->passwordInput(['value'=>''],['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Cambiar Clave', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
