<?php

/* @var $this yii\web\View */

$this->title = 'Inicio';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Cocineros Unidos</h1>
        <p class="lead">Bienvenido/a! Aquí podrás compartir tus recetas con otros cocineros a nivel mundial!</p>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h2>Productos</h2>
            <p>
                Ver los Productos que existen actualmente para su uso en las Recetas. Si eres Administrador, podrás añadirlos.
            </p>
            <p><a class="btn btn-default" href="../web/index.php?r=productostbl">Ir a Productos &raquo;</a></p>
        </div>
        <div class="col-md-3">
            <h2>Recetas</h2>
            <p>Ver, crear, valorar y editar Recetas. Sólo si eres el Creador de una Receta, tienes el derecho a editarla/eliminarla.</p>
            <p><a class="btn btn-default" href="../web/index.php?r=recetastbl">Ir a Recetas &raquo;</a></p>
        </div>
        <div class="col-md-3">
            <h2>Usuarios</h2>
            <p>Ver los Usuarios Registrados previamente que participan en nuestra Comunidad.</p>
            <p><a class="btn btn-default" href="../web/index.php?r=usuariostbl">Ir a Usuarios &raquo;</a></p>
        </div>
        <div class="col-md-3">
            <h2>Ranking</h2>
            <p>Acceder al Ranking de Cocineros con más Estrellas, y Recetas Mejor Valoradas.</p>
            <p><a class="btn btn-default" href="../web/index.php?r=ranking">Ir a Ranking &raquo;</a></p>
        </div>
    </div>
</div>
