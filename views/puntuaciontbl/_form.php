<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Puntuaciontbl */
/* @var $model2 app\models\Recetastbl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puntuaciontbl-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- el campo de valoracion pasa a ser un radio button list, en lugar de un campo de texto -->
    <?= $form->field($model, 'valoracion')->radioList(array(1=>'1 Estrella',2=>'2 Estrellas',
        3=>'3 Estrellas',4=>'4 Estrellas',5=>'5 Estrellas')); ?>

  
    <div class="row">
        <div class="col-md-2">
            <label class="control-label">Usuario que Valora:</label>
        </div>
        <div class="col-md-4">
            <label><font color="blue"><?=Yii::$app->user->identity->username ?></font></label>
            
        </div>
    </div> 
    <!--Este campo oculto tiene el id del usuario conectado, que esta valorando la receta-->
    <?= $form->field($model,'usuariostbl_id')->hiddenInput(['value'=> Yii::$app->user->identity->id])->label(false)?>

    <div class="row">
        <div class="col-md-2">
            <label class="control-label">Receta que Valora:</label>
        </div>
        <div class="col-md-4">
            
            <label><font color="blue"><?=$model2->receta?></font></label>
            
        </div>
    </div> 
    
    <!--Este campo oculto tiene el id de la receta que se esta valorando-->
    <?= $form->field($model,'recetastbl_id')->hiddenInput(['value'=> $model2->id])->label(false)?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Valorar' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
