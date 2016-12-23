<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuariostbl */

$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
