<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecetastblSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cocineros con más Recetas';
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
                <th>Cocinero</th>
                <th>Total Recetas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($cocinerosArray); $i++) {
                ?>

                <tr>
                    <td><?=$i+1?></td>
                    <td><?=$cocinerosArray[$i]->nombre ?> <?=$cocinerosArray[$i]->apellido ?></td>
                    <td><?=$cantidadesArray[$i]?></td>
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
