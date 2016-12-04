<?php

namespace app\controllers;

use Yii;
use app\models\Recetastbl;
use app\models\RecetastblSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecetastblController implements the CRUD actions for Recetastbl model.
 */
class RecetastblController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Recetastbl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecetastblSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recetastbl model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Recetastbl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recetastbl();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Recetastbl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Recetastbl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Responde a la url "http://localhost/prueba3hweb/web/index.php?r=recetastbl/masrecetas"
     * Ranking de los cocineros con mas recetas.
     */
    public function actionMasrecetas() { 
        $cocineros = \app\models\Usuariostbl::find()->all();
        $recetas = Recetastbl::find()->all();
        $index = 0;
        foreach ($cocineros as $cocinero) {
            $index;
            $cuentaRecetas = 0;
            $myArray[$index][1] = $cocinero;
            foreach ($recetas as $receta) {

                if ($receta->usuariostbl_id == $cocinero->id) {

                    $cuentaRecetas++;
                }
            }
            $myArray[$index][2] = $cuentaRecetas;
            $index++;
        }

        $cont = 0;
        $cont1 = 0;
        $cont2 = 1;
        $ultimoMayor = -2;
        $primeraVuelta = true;
        echo '<link href="/prueba3hweb/web/assets/7668a6c7/css/bootstrap.css" rel="stylesheet">';
        echo '<script src="/prueba3hweb/web/assets/ec8baf58/jquery.js"></script><script src="/prueba3hweb/web/assets/88c8d4fd/yii.js"></script><script src="/prueba3hweb/web/assets/7668a6c7/js/bootstrap.js"></script>';
        echo '<div class="container">
  <h2>Cocineros con más recetas</h2>
  </br>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Lugar</th>
        <th>Cocinero</th>
        <th>Total Recetas</th>
      </tr>
    </thead>
    <tbody>';

        //Calcula e imprime en orden de mayor a menor cantidad de recetas
        while ($cont1 < $index) {
            $mayor = -1;
            while ($cont < $index) {
                if (($myArray[$cont][2] > $mayor && $ultimoMayor > $myArray[$cont][2]) || ($primeraVuelta && $myArray[$cont][2] > $mayor)) {
                    $mayor = $myArray[$cont][2];
                    $mayorAr[0] = $myArray[$cont][1];
                    $mayorAr[1] = $myArray[$cont][2];
                } else {
                    if ($ultimoMayor == 0 && $myArray[$cont][2] == 0) {
                        $mayor = $myArray[$cont][2];
                        $mayorAr[0] = $myArray[$cont][1];
                        $mayorAr[1] = $myArray[$cont][2];
                    }
                }
                if ($cont == $index - 1) {

                    echo '<tr>
                            <td>' . $cont2 . '</td>
                            <td>' . $mayorAr[0]->nombre . ' '.$mayorAr[0]->apellido.'</td>
                            <td>' . $mayorAr[1] . '</td>
                        </tr>';
                    //echo $mayorAr[0]->nombre . ' : ' . $mayorAr[1];
                    //echo ' - ';
                    $cont2++;
                    $ultimoMayor = $mayorAr[1];
                }

                $cont++;
            }
            $primeraVuelta = false;
            $cont = 0;
            $cont1++;
        }
        echo '</tbody></table></div>';

        //Este return lo puse solo para relleno, no se que retornar aun
        //return $this->redirect(['index']);
    }
    
    /**
     * Responde a la url "http://localhost/prueba3hweb/web/index.php?r=recetastbl/mpromestrellas"
     * Ranking de los cocineros con mas recetas.
     */
    public function actionMpromestrellas() { 
        $puntuaciones = \app\models\Puntuaciontbl::find()->all();
        $recetas = Recetastbl::find()->all();
        $index = 0;
        foreach ($recetas as $receta) {
            $index;
            $cuentaRecetas = 0;
            $valorAcumulado = 0;
            $promedio = 0;
            $myArray[$index][1] = $receta;
            foreach ($puntuaciones as $puntuacion) {

                if ($puntuacion->recetastbl_id == $receta->id) {
                    $valorAcumulado += $puntuacion->valoracion;
                    $cuentaRecetas++;
                }
            }
            if($cuentaRecetas == 0)
            {
                $promedio = 0;
                $myArray[$index][2] = $promedio;
            }else
            {
                $promedio =(1.00*$valorAcumulado)/(1.00*$cuentaRecetas);
                $myArray[$index][2] = $promedio;
            }
            
            $index++;
        }
        $cont = 0;
        $cont1 = 0;
        $cont2 = 1;
        $ultimoMayor = -2;
        $primeraVuelta = true;
        echo '<link href="/prueba3hweb/web/assets/7668a6c7/css/bootstrap.css" rel="stylesheet">';
        echo '<script src="/prueba3hweb/web/assets/ec8baf58/jquery.js"></script><script src="/prueba3hweb/web/assets/88c8d4fd/yii.js"></script><script src="/prueba3hweb/web/assets/7668a6c7/js/bootstrap.js"></script>';
        echo '<div class="container">
  <h2>Recetas con mejor promedio de estrellas</h2>
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
    <tbody>';

        //Calcula e imprime en orden de mayor a menor promedio de estrellas
        while ($cont1 < $index) {
            $mayor = -1;
            while ($cont < $index) {
                if (($myArray[$cont][2] > $mayor && $ultimoMayor > $myArray[$cont][2]) || ($primeraVuelta && $myArray[$cont][2] > $mayor)) {
                    $mayor = $myArray[$cont][2];
                    $mayorAr[0] = $myArray[$cont][1];
                    $mayorAr[1] = $myArray[$cont][2];
                } else {
                    if ($ultimoMayor == 0 && $myArray[$cont][2] == 0) {
                        $mayor = $myArray[$cont][2];
                        $mayorAr[0] = $myArray[$cont][1];
                        $mayorAr[1] = $myArray[$cont][2];
                    }
                }
                if ($cont == $index - 1) {

                    echo '<tr>
                            <td>' . $cont2 . '</td>
                            <td>' . $mayorAr[0]->receta.'</td>
                            <td>' . $mayorAr[0]->usuariostbl->nombre.' '.$mayorAr[0]->usuariostbl->apellido.'</td>
                            <td>' . $mayorAr[1] . '</td>
                        </tr>';
                    //echo $mayorAr[0]->nombre . ' : ' . $mayorAr[1];
                    //echo ' - ';
                    $cont2++;
                    $ultimoMayor = $mayorAr[1];
                }

                $cont++;
            }
            $primeraVuelta = false;
            $cont = 0;
            $cont1++;
        }
        echo '</tbody></table></div>';

        //Este return lo puse solo para relleno, no se que retornar aun
        //return $this->redirect(['index']);
    }

    /**
     * Finds the Recetastbl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recetastbl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recetastbl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
