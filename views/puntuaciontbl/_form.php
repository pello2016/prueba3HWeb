<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Puntuaciontbl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puntuaciontbl-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- el campo de valoracion pasa a ser un radio button list, en lugar de un campo de texto -->
    <?= $form->field($model, 'valoracion')->radioList(array(1=>'1 Estrella',2=>'2 Estrellas',
        3=>'3 Estrellas',4=>'4 Estrellas',5=>'5 Estrellas')); ?>

    <!-- aqui se recibe el arreglo usuarios con los elementos de la tabla de usuarios en un dropdown -->
    <?= $form->field($model, 'usuariostbl_id')->dropDownList($usuarios, ['prompt'=>'-Elija un Usuario-'],
            //aqui se intenta seleccionar por defecto la receta de la cual proviene mediante un id, pero
            //aun no esta funcional. esto, debido a que no se estan utilizando sesiones
            ['options' =>
                    [                        
                      $model2->id => ['Selected' => 'selected']
                    ]
            ]) ?>

    <!-- aqui se recibe el arreglo recetas con los elementos de la tabla de recetas en un dropdown -->
    <?= $form->field($model, 'recetastbl_id')->dropDownList($recetas, ['prompt'=>'-Elija una Receta-']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Valorar' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
