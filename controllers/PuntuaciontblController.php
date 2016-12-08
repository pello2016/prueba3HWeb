<?php

namespace app\controllers;

use Yii;
use app\models\Puntuaciontbl;
use app\models\PuntuaciontblSearch;
use app\models\Recetastbl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;

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
    public function actionCreate($id) {
        $model = new Puntuaciontbl();
        //mediante el id que se recibe, se acceden a los datos de la receta de la cual proviene
        //la llamada, para asi, referenciarlos a la vista
        $model2 = Recetastbl::findOne($id);
        //ademas, se le envian arreglos con los usuarios y las recetas, para poder ser elegidas
        //mediante un dropdown en la vista
        $usuarios = ArrayHelper::map(\app\models\Usuariostbl::find()->all(), 'id', 'username');
        $recetas = ArrayHelper::map(\app\models\Recetastbl::find()->all(), 'id', 'receta');

        //el save se traslada luego de la validacion de si ya se valoro con un usuario o no
        if ($model->load(Yii::$app->request->post())) {
            
            $puntuaciones = Puntuaciontbl::find()->all();
            $valorado = false;
            
            foreach ($puntuaciones as $puntuacion) {
                
                if ($puntuacion->recetastbl_id == $model->recetastbl_id) {
                    
                    if ($puntuacion->usuariostbl_id == $model->usuariostbl_id) {
                        $valorado = true;
                    }
                }
            }
            
            if($valorado == true){
                //al final no se pudo solucionar el problema de renderizacion de las alertas, pero por lo menos la muestra
                echo Alert::widget([ 'options' => [ 'class' => 'alert-info', ], 'body' => 'Ya se ha valorado anteriormente con este usuario', ]);
            }
            else{
                //de ser correcta la validacion por post, se redirige a la lista de recetas y no a la
                //de puntuaciones, ya que el llamado proviene de la primera
                $model->save();
                return $this->redirect(['recetastbl/index']);
            }
        } else {
            //se envian a la vista los elementos provenientes del controlador
            return $this->render('create', [
                        'model' => $model,
                        'model2' => $model2,
                        'usuarios' => $usuarios,
                        'recetas' => $recetas
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
        $model2 = $this->findModel($id);
        $usuarios = ArrayHelper::map(\app\models\Usuariostbl::find()->all(), 'id', 'username');
        $recetas = ArrayHelper::map(\app\models\Recetastbl::find()->all(), 'id', 'receta');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'model2' => $model2,
                        'usuarios' => $usuarios,
                        'recetas' => $recetas
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
            $acumulado = 0; 
            foreach ($puntuaciones as $puntuacion) {

                if ($puntuacion->recetastbl->usuariostbl->id == $cocinero->id) {

                    $acumulado += $puntuacion->valoracion;
                }
            }
            $acumuladoArray[$index] = $acumulado; 

            $index++;
        }

        rsort($acumuladoArray);

        $index2 = 0;
        while ($index2 < count($acumuladoArray)) {

            foreach ($cocineros as $cocinero) { 
                $acumulado = 0; 
                foreach ($puntuaciones as $puntuacion) {

                    if ($puntuacion->recetastbl->usuariostbl->id == $cocinero->id) {

                        $acumulado += $puntuacion->valoracion;
                    }
                } 
                
                if ($acumuladoArray[$index2] == $acumulado) {
                    $cocinerosArray[$index2] = $cocinero;
                    $index2++;
                }
                
                if ($index2 == count($acumuladoArray)) {
                    break;
                }

                $index++;
            }
        }

        return $this->render('masestrellas', [
                    'cocinerosArray' => $cocinerosArray,
                    'acumuladoArray' => $acumuladoArray
        ]);
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
