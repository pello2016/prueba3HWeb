<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecetastblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recetas Mejor Valoradas';
$this->params['breadcrumbs'][] = ['label' => 'Ranking', 'url' => ['ranking/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetastbl-index">

    <h1><?= Html::encode($this->title) ?></h1>

    </br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lugar</th>
                <th>Receta</th>
                <th>Autor</th>
                <th>Promedio Estrellas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($recetasArray); $i++) {
                ?>

                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $recetasArray[$i]->receta?></td>
                    <td><?= $recetasArray[$i]->usuariostbl->nombre ?> <?= $recetasArray[$i]->usuariostbl->apellido ?></td>
                    <td><?= $cantidadesArray[$i] ?></td>
                </tr>


                <?php
            }
            ?>


        </tbody>
    </table>
</div>


<div>
    <a class="btn btn-default" href="../web/index.php">Volver al Inicio &raquo;</a>
</div>
</div>
