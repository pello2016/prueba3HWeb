<?php

namespace app\controllers;

use Yii;
use app\models\Recetastbl;
use app\models\RecetastblSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * RecetastblController implements the CRUD actions for Recetastbl model.
 */
class RecetastblController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete', 'view', 'index', 'masrecetas', 'mpromestrellas'],
                        'roles' => ['administrador', 'usuario'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Funcion recibe id de la receta, y la id del usuario conectado.
     * Verifica si es el dueño y retorna true o false, segun corresponda
     * 
     * @param type $idReceta
     * @param type $idConectado
     * @return boolean
     */
    public function isOwner($idReceta, $idConectado) {

        //se busca el modelo de la receta
        $receta = $this->findModel($idReceta);
        //se verifica si el usuario conectado es el dueño de la receta o no.
        if ($receta->usuariostbl_id == $idConectado) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lists all Recetastbl models.
     * @return mixed
     */
    public function actionIndex() {
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
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Recetastbl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Recetastbl();
        $items = ArrayHelper::map(\app\models\Usuariostbl::find()->all(), 'id', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Importante, verificar primero si la receta tienen ingredientes o no.
            if (Yii::$app->request->post('cantidad') && Yii::$app->request->post('unidad') ) 
                {
                //la receta recibida, tiene ingredientes.
                
                //Se reciben los 3 arreglos enviados atraves de post
                $ingredientes = Yii::$app->request->post('ingrediente');
                $cantidades = Yii::$app->request->post('cantidad');
                $unidades = Yii::$app->request->post('unidad');

                //Al momento de hacer $model->save, el model contendra la ID AutoIncrementable asignada por la BD
                $index = 0; //contador usado para recorrer ciertos elementos de los arreglos
                //se corren todos los elementos correspondientes a los ingredientes
                foreach ($cantidades as $cantidad) {
                    //para la lista de ingredientes inicia en 1 y no 0
                    //se crea una nueva variable que guardara el nuevo ingrediente
                    $ingredienteModel = new \app\models\Recetasproducto();

                    //se asocia a la receta usando la id
                    $ingredienteModel->recetastbl_id = $model->id;
                    //se asocia el producto (ingrediente) usando su id
                    $ingredienteModel->productostbl_id = $ingredientes[$index + 1];
                    //se agrega la cantidad
                    $ingredienteModel->cantidad = $cantidad;
                    //se agrega la unidad de medida
                    $ingredienteModel->unidad = $unidades[$index];

                    //se guarda el ingrediente en la BD
                    $ingredienteModel->save();
                    $index++;
                }
            }
            //Mensaje de exito, que se recupera en el index de Recetastbl o el view
            Yii::$app->getSession()->setFlash('success', 'Receta creada con exito.');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'items' => $items
            ]);
        }
    }

    /**
     * Updates an existing Recetastbl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $items = ArrayHelper::map(\app\models\Usuariostbl::find()->all(), 'id', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $cantidadIngredientes = 0;
            //verifica que no vengan vacios
            if (Yii::$app->request->post('cantidad') && Yii::$app->request->post('unidad')) {
                //Se reciben los 3 arreglos enviados atraves de post
                $ingredientes = Yii::$app->request->post('ingrediente');
                $cantidades = Yii::$app->request->post('cantidad');
                $unidades = Yii::$app->request->post('unidad');
                $cantidadIngredientes = count($cantidades);
            }


            //se deben buscar en la BD todos los ingredientes asociados a esta receta
            $ingredientesEnBD = \app\models\Recetasproducto::find()->where(['recetastbl_id' => $id])->all();
            $index = 0;

            //Se recorren los ingredientes que habia en la BD
            foreach ($ingredientesEnBD as $ingrediente) {
                if ($index < $cantidadIngredientes) {
                    //se reemplazan sus valores por los contenidos en los arreglos correspondientes.
                    $ingrediente->productostbl_id = $ingredientes[$index + 1];
                    $ingrediente->cantidad = $cantidades[$index];
                    $ingrediente->unidad = $unidades[$index];
                    $ingrediente->save(); //se guardan los nuevos datos en la BD
                } else {
                    //la receta tiene menos ingredientes que antes, lo restantes se eliminaran.
                    $ingrediente->delete();
                }

                $index++;
            }

            //En caso que hayan nuevos ingredientes, este for los genera y guarda en la BD
            for ($index; $index < $cantidadIngredientes; $index++) {
                //para la lista de ingredientes es index+1
                //se crea una nueva variable que guardara el nuevo ingrediente
                $ingredienteModel = new \app\models\Recetasproducto();

                //se asocia a la receta usando la id
                $ingredienteModel->recetastbl_id = $model->id;
                //se asocia el producto (ingrediente) usando su id
                $ingredienteModel->productostbl_id = $ingredientes[$index + 1];
                //se agrega la cantidad
                $ingredienteModel->cantidad = $cantidades[$index];
                //se agrega la unidad de medida
                $ingredienteModel->unidad = $unidades[$index];

                //se guarda el ingrediente en la BD
                $ingredienteModel->save();
            }
            //Mensaje de exito, que se recupera en el index de Recetastbl o el view
            Yii::$app->getSession()->setFlash('success', 'Receta actualizada con exito.');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'items' => $items
            ]);
        }
    }

    /**
     * Deletes an existing Recetastbl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        $searchModel = new RecetastblSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //Mensaje de exito, que se recupera en el index de Recetastbl o el view
        Yii::$app->getSession()->setFlash('success', 'Receta eliminada con exito.');

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
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
            foreach ($recetas as $receta) {

                if ($receta->usuariostbl_id == $cocinero->id) {

                    $cuentaRecetas++;
                }
            }
            $cantidadRecetas[$index] = $cuentaRecetas;
            $index++;
        }


        rsort($cantidadRecetas);

        $index2 = 0;
        while ($index2 < count($cantidadRecetas)) {


            //$cantidadRecetas;
            foreach ($cocineros as $cocinero) {

                $cuentaRecetas = 0;
                foreach ($recetas as $receta) {

                    if ($receta->usuariostbl_id == $cocinero->id) {

                        $cuentaRecetas++;
                    }
                }
                if ($cantidadRecetas[$index2] == $cuentaRecetas) {
                    $cocinerosArray[$index2] = $cocinero;
                    $index2++;
                }
                if ($index2 == count($cantidadRecetas)) {
                    break;
                }
            }
        }

        return $this->render('rmasrecetas', [
                    'cocinerosArray' => $cocinerosArray,
                    'cantidadRecetas' => $cantidadRecetas//$cantidadesArray
        ]);
    }

    /**
     * Responde a la url "http://localhost/prueba3hweb/web/index.php?r=recetastbl/mpromestrellas"
     * Ranking de los cocineros con mas recetas.
     */
    public function actionMpromestrellas() {
        $puntuaciones = \app\models\Puntuaciontbl::find()->all();
        $recetas = Recetastbl::find()->all();
        $index = 0;

        //recorre recetas y para cada receta, recorre las puntuaciones.
        foreach ($recetas as $receta) {
            $cuentaRecetas = 0;
            $valorAcumulado = 0;
            $promedio = 0;
            $myArray[$index][1] = $receta;
            foreach ($puntuaciones as $puntuacion) {
                //si corresponde valoracion de esta receta
                if ($puntuacion->recetastbl_id == $receta->id) {
                    $valorAcumulado += $puntuacion->valoracion;
                    $cuentaRecetas++;
                }
            }
            //calcula promedio dependiendo de la cantidad de valoraciones y recetas.
            if ($cuentaRecetas == 0) {
                $promedio = 0;
            } else {
                $promedio = (1.00 * $valorAcumulado) / (1.00 * $cuentaRecetas);
            }
            //guarda el promedio resultante en el arreglo
            $promediosArray[$index] = $promedio;

            $index++;
        }

        //ordena promedios de mayor a menor
        rsort($promediosArray);

        $index2 = 0;
        //recorre el arreglo de promedios ya ordenado.
        while ($index2 < count($promediosArray)) {
            //recorre cada receta y si el promedio coincide con el almacenado en $promediosArray, se guarda la receta.
            //dentro de una arreglo de recetas, para que de esta forma esten en el mismo orden que los promedios
            foreach ($recetas as $receta) {
                $cuentaRecetas = 0;
                $valorAcumulado = 0;
                $promedio = 0;
                foreach ($puntuaciones as $puntuacion) {

                    if ($puntuacion->recetastbl_id == $receta->id) {
                        $valorAcumulado += $puntuacion->valoracion;
                        $cuentaRecetas++;
                    }
                }
                if ($cuentaRecetas == 0) {
                    $promedio = 0;
                } else {
                    $promedio = (1.00 * $valorAcumulado) / (1.00 * $cuentaRecetas);
                }
                //si el promedio es igual al del arreglo de promedios
                if ($promediosArray[$index2] == $promedio) {
                    //se guarda la receta
                    $recetasArray[$index2] = $receta;
                    $index2++;
                }
                if ($index2 == count($promediosArray)) {
                    //para evitar que se salga del indice maximo, se hace un break.
                    //ya que tendriamos todas las recetas almacenadas
                    break;
                }
            }
        }


        return $this->render('mpromestrellas', [
                    'recetasArray' => $recetasArray,
                    'promediosArray' => $promediosArray
        ]);
    }

    /**
     * Metodo retorna un array con el id y nombre de los
     * productos que existan en la BD
     */
    public function getProductos() {
        $productosArray = ArrayHelper::map(\app\models\Productostbl::find()->all(), 'id', 'producto');
        return $productosArray;
    }

    /**
     * Metodo retorna un array con los objetos de ingredientes asociados a la receta
     * 
     */
    public function getIngredientes($id) {
        $ingredientesArray = \app\models\Recetasproducto::find()->where(['recetastbl_id' => $id])->all();
        return $ingredientesArray;
    }

    /**
     * Finds the Recetastbl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recetastbl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Recetastbl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
