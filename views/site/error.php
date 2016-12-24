<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El error indicado ocurrió mientras el Servidor Web estaba procesando su solicitud.
    </p>
    <p>
        Por favor, contáctenos si cree que se trata de un error de servidor. Gracias.
    </p>

</div>
