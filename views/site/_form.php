<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php }
    else { ?>
        <div class="row">
            <div class="col-md-1">
                <label class="control-label">Usuario:</label>
            </div>
            <div class="col-md-4">
                <label><font color="blue"><?= $model->username ?></font></label>
            </div>
        </div>
        <?= $form->field($model,'rolestbl_id')->hiddenInput(['value'=> $model->rolestbl_id])->label(false)?>
    <?php }
    ?>
    
    <?php 
    if ($model->isNewRecord) { ?>
        <!-- si un usuario se esta registrando, es necesario mostrar el campo clave -->
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php }
    else { ?>
        <!-- caso contrario, no debe mostrarse, puesto que existe un form especifico para cambiar la clave -->
    <?php }
    ?>
    
    <?php //$form->field($model, 'authKey')->hiddenInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?php 
    if ($model->isNewRecord) { ?>
        <!-- aqui se recibe el arreglo items con los elementos de la tabla de roles en un dropdown -->
        <?= $form->field($model, 'rolestbl_id')->dropDownList($items, ['prompt'=>'-Elija un Rol-']) ?>
    <?php }
    else { ?>
        <div class="row">
            <div class="col-md-1">
                <label class="control-label">Rol:</label>
            </div>
            <div class="col-md-4">
                <label><font color="blue"><?= $model->rolestbl->rol ?></font></label>
            </div>
        </div>
        <?= $form->field($model,'rolestbl_id')->hiddenInput(['value'=> $model->rolestbl_id])->label(false)?>
    <?php }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrarse' : 'Guardar Cambios', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
