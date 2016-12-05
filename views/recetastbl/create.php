<?php

use yii\helpers\Html;
use app\models\Productostbl;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Recetastbl */

$this->title = 'Create Recetastbl';
$this->params['breadcrumbs'][] = ['label' => 'Recetastbls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetastbl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    

</div>
<script src="/prueba3hweb/web/scripts/funciones.js" type="text/javascript"></script>