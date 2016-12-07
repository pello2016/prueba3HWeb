<?php

/* @var $this yii\web\View */

$this->title = 'Ranking';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranking-index">

    <h2>Ranking</h2>

    <table class="table">
        <tr>
            <th>
                <a class="btn btn-default" href="../web/index.php?r=puntuaciontbl/masestrellas">Cocineros con más Estrellas</a>
            </th>
            <th>
                <a class="btn btn-default" href="../web/index.php?r=recetastbl/masrecetas">Cocineros con más Recetas</a>
            </th>
            <th>
                <a class="btn btn-default" href="../web/index.php?r=recetastbl/mpromestrellas">Recetas Mejor Valoradas</a>
            </th>
        </tr>
    </table>

    <div>
        <a class="btn btn-default" href="../web/index.php">Volver al Inicio &raquo;</a>
    </div>
</div>
