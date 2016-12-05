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

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]); ?>

    <?= $form->field($model, 'preparacion')->textarea(['maxlength' => true]); ?>

    <?= $form->field($model, 'usuariostbl_id')->dropDownList($items, ['prompt'=>'-Elija un Usuario-']) ?>

    <div hidden>
        <div class="form-group" id="lista">
            <div class="row">
                <label class="control-label col-md-2">Ingrediente</label>  
                <div class="col-xs-5" style="padding-top: 7px;">
                    <?php echo Html::dropDownList('ingrediente[]', 'id', $this->context->getProductos()); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group" >
        <div class="row">
            <div class="col-md-10">             
                <input type="button" value="Agregar ingredientes" class="btn btn-default" onclick="addIngredientes();"/>
                <input type="number" id="cantIngredientes" name="cantIngredientes" value="">
            </div>
        </div>

    </div>

    <div id="container-recetas" style="padding-left:50px">

    </div>

    <div class="form-group">
        <div class="row">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
