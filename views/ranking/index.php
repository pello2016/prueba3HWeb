<?php

/* @var $this yii\web\View */

$this->title = 'Ranking';
?>
<div class="ranking-index">

    <h2>Ranking</h2>

    <table class="table">
        <tr>
            <th>
                <a class="btn btn-default" href="../web/index.php?r=usuariostbl/moststarsuser">Cocineros con más Estrellas</a>
            </th>
            <th>
                <a class="btn btn-default" href="../web/index.php?r=usuariostbl/mostrecipesuser">Cocineros con más Recetas</a>
            </th>
            <th>
                <a class="btn btn-default" href="../web/index.php?r=usuariostbl/bestrankingrecipes">Recetas Mejor Valoradas</a>
            </th>
        </tr>
    </table>

    <div>
        <a class="btn btn-default" href="../web/index.php">Volver al Inicio &raquo;</a>
    </div>
</div>
