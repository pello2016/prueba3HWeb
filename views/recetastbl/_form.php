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

    <?php 
    if ($model->isNewRecord) { ?>
        <!--si es un nuevo registro, se toma el username de quien esta conectado actualmente, y se muestra dentro
            del form, el que a su vez contiene el id requerido por la bd en un campo oculto-->
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Autor:</label>
            </div>
            <div class="col-md-4">
                <label><font color="blue"><?= Yii::$app->user->identity->username ?></font></label>
            </div>
        </div>
        
        <!--Este campo oculto tiene el id del usuario conectado, que esta creando la receta-->
        <?= $form->field($model,'usuariostbl_id')->hiddenInput(['value'=> Yii::$app->user->identity->id])->label(false)?>
    <?php }
    else { ?>
        <!--caso contrario, se muestra el autor de una receta anteriormente creada, pero que no puede modificarse-->
        <div class="row">
            <div class="col-md-2">
                <label class="control-label">Autor:</label>
            </div>
            <div class="col-md-4">
                <label><font color="blue"><?= $model->usuariostbl->username ?></font></label>
            </div>
        </div>

        <!--Este campo oculto tiene el id del usuario que creo la receta-->
        <?= $form->field($model,'usuariostbl_id')->hiddenInput(['value'=> $model->usuariostbl_id])->label(false)?>
    <?php }
    ?>

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
                <input type="button" value="Agregar Ingredientes" class="btn btn-default" onclick="addIngredientes();"/>
                <input type="number" id="cantIngredientes" name="cantIngredientes" value="">
            </div>
        </div>
    </div>

    <?php
    //Se llama al metodo que retorna todos los ingredientes para esta receta.
    $model2Array = $this->context->getIngredientes($model->id)
    ?>
    <div id="container-recetas" style="padding-left:50px">
        <?php
        //solo se ejecuta si el array es distinto de null
        $ingId = 0;
        foreach ($model2Array as $ingrediente) {
            $ingId++;
        ?>
            <div class="form-group" id="ing<?= $ingId ?>">
                <div class="form-group" id="lista">
                    <div class="row">
                        <label class="control-label col-md-2">Ingrediente</label>  
                        <div class="col-xs-5" style="padding-top: 7px;">
                            <?php echo Html::dropDownList('ingrediente[]', 'id', $this->context->getProductos(), ['options' => [$ingrediente->productostbl->id => ['Selected' => true]]]); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-md-2">Cantidad</label>
                        <div class="col-xs-7">
                            <input type="text" name="cantidad[]" id="cantidad" value=<?= $ingrediente->cantidad ?>>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-md-2">Unidad</label>
                        <div class="col-xs-7">
                            <input type="text" name="unidad[]" id="unidad" value=<?= $ingrediente->unidad ?>>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="button" value="Quitar" class="btn btn-default" onclick="eliminaIngrediente(ing<?= $ingId ?>) ;">
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        <?php
        }
        ?> 

    </div>

    <div class="form-group">
        <div class="row">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar Cambios', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
