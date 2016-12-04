<?php

namespace app\controllers;

use Yii;
use app\models\Puntuaciontbl;
use app\models\PuntuaciontblSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PuntuaciontblController implements the CRUD actions for Puntuaciontbl model.
 */
class PuntuaciontblController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Puntuaciontbl models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PuntuaciontblSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Puntuaciontbl model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Puntuaciontbl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Puntuaciontbl();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Puntuaciontbl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
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
     * Deletes an existing Puntuaciontbl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Metodo se encarga de responder a la consulta de la url "http://localhost/prueba3hweb/web/index.php?r=puntuaciontbl/masestrellas"
     * 
     * @return type
     */
    public function actionMasestrellas() { //MasEstrellas()
        $cocineros = \app\models\Usuariostbl::find()->all();
        $puntuaciones = Puntuaciontbl::find()->all();
        $index = 0;
        foreach ($cocineros as $cocinero) {
            $index;
            $acumulado = 0;
            $myArray[$index][1] = $cocinero;
            foreach ($puntuaciones as $puntuacion) {

                if ($puntuacion->recetastbl->usuariostbl->id == $cocinero->id) {

                    $acumulado += $puntuacion->valoracion;
                }
            }
            $myArray[$index][2] = $acumulado;
            
            $index++;
        }
        //arsort($myArray);
        //array_multisort($myArray, SORT_NUMERIC,SORT_DESC);
        $cont = 0;
        $cont1 = 0;
        $cont2 = 1;
        $ultimoMayor = -2;
        $primeraVuelta = true;
        echo '<link href="/prueba3hweb/web/assets/7668a6c7/css/bootstrap.css" rel="stylesheet">';
        echo '<script src="/prueba3hweb/web/assets/ec8baf58/jquery.js"></script><script src="/prueba3hweb/web/assets/88c8d4fd/yii.js"></script><script src="/prueba3hweb/web/assets/7668a6c7/js/bootstrap.js"></script>';
        echo '<div class="container">
  <h2>Cocineros con más estrellas acumuladas</h2>
  </br>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Lugar</th>
        <th>Cocinero</th>
        <th>Total Estrellas</th>
      </tr>
    </thead>
    <tbody>';

        //Calcula e imprime en orden de mayor a menor estrellas acumuladas
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
     * Finds the Puntuaciontbl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Puntuaciontbl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Puntuaciontbl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
