<?php

namespace app\controllers;

use Yii;
use app\models\Recetastbl;
use app\models\RecetastblSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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
        $items = ArrayHelper::map(\app\models\Usuariostbl::find()->all(), 'id', 'username');
        
        if ($model->load(Yii::$app->request->post())  && $model->save()) {
            
            //Se reciben los 3 arreglos enviados atraves de post
            $ingredientes = Yii::$app->request->post('ingrediente');
            $cantidades = Yii::$app->request->post('cantidad');
            $unidades = Yii::$app->request->post('unidad');
            
            //Al momento de hacer $model->save, el model contendra la ID AutoIncrementable asignada por la BD
            $index = 0;//contador usado para recorrer ciertos elementos de los arreglos
            //se corren todos los elementos correspondientes a los ingredientes
            foreach($cantidades as $cantidad){
                //para la lista de ingredientes inicia en 1 y no 0
                
                //se crea una nueva variable que guardara el nuevo ingrediente
                $ingredienteModel = new \app\models\Recetasproducto(); 
                
                //se asocia a la receta usando la id
                $ingredienteModel->recetastbl_id = $model->id;
                //se asocia el producto (ingrediente) usando su id
                $ingredienteModel->productostbl_id = $ingredientes[$index+1];
                //se agrega la cantidad
                $ingredienteModel->cantidad = $cantidad;
                //se agrega la unidad de medida
                $ingredienteModel->unidad = $unidades[$index];
                    
                //se guarda el ingrediente en la BD
                $ingredienteModel->save();
                $index++;
            }
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $items = ArrayHelper::map(\app\models\Usuariostbl::find()->all(), 'id', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //Se reciben los 3 arreglos enviados atraves de post
            $ingredientes = Yii::$app->request->post('ingrediente');
            $cantidades = Yii::$app->request->post('cantidad');
            $unidades = Yii::$app->request->post('unidad');          
            
            //se deben buscar en la BD todos los ingredientes asociados a esta receta
            $ingredientesEnBD =  \app\models\Recetasproducto::find()->where(['recetastbl_id' => $id])->all();
            $index = 0;
            
            //Se recorren los ingredientes que habia en la BD
            foreach($ingredientesEnBD as $ingrediente){
                //se reemplazan sus valores por los contenidos en los arreglos correspondientes.
                $ingrediente->productostbl_id = $ingredientes[$index+1];
                $ingrediente->cantidad = $cantidades[$index];
                $ingrediente->unidad = $unidades[$index];
                $ingrediente->save(); //se guardan los nuevos datos en la BD
                $index++;
            }
            
            //En caso que hayan nuevos ingredientes, este for los genera y guarda en la BD
            for($index;$index < count($cantidades); $index++){
                //para la lista de ingredientes es index+1
                
                //se crea una nueva variable que guardara el nuevo ingrediente
                $ingredienteModel = new \app\models\Recetasproducto();
                
                //se asocia a la receta usando la id
                $ingredienteModel->recetastbl_id = $model->id;
                //se asocia el producto (ingrediente) usando su id
                $ingredienteModel->productostbl_id = $ingredientes[$index+1];
                //se agrega la cantidad
                $ingredienteModel->cantidad = $cantidades[$index];
                //se agrega la unidad de medida
                $ingredienteModel->unidad = $unidades[$index];               
                
                //se guarda el ingrediente en la BD
                $ingredienteModel->save();
            }         
            
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
        $ultimoMayor = -2;
        $primeraVuelta = true; 

        $indexArray = 0; 
               
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

                    //almacena los datos a ser enviados en el orden mayor a menor
                    $cocinerosArray[$indexArray] = $mayorAr[0];
                    $cantidadesArray[$indexArray] = $mayorAr[1];
                    $indexArray++; 
                    
                    $ultimoMayor = $mayorAr[1];
                }

                $cont++;
            }
            $primeraVuelta = false;
            $cont = 0;
            $cont1++;
        }

        return $this->render('rmasrecetas', [
                'cocinerosArray' => $cocinerosArray,
                'cantidadesArray' => $cantidadesArray
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
        $ultimoMayor = -2;
        $primeraVuelta = true;

        $indexArray = 0;
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

                    //almacena los datos a ser enviados en el orden mayor a menor
                    $recetasArray[$indexArray] = $mayorAr[0];
                    $cantidadesArray[$indexArray] = $mayorAr[1];
                    $indexArray++;
                    
                    $ultimoMayor = $mayorAr[1];
                }

                $cont++;
            }
            $primeraVuelta = false;
            $cont = 0;
            $cont1++;
        }

        return $this->render('mpromestrellas', [
                'recetasArray' => $recetasArray,
                'cantidadesArray' => $cantidadesArray
            ]);
    }
    
    /**
     * Metodo retorna un array con el id y nombre de los
     * productos que existan en la BD
     */
    public function getProductos()
    {
        $productosArray = ArrayHelper::map(\app\models\Productostbl::find()->all(), 'id', 'producto');
        return $productosArray;
    }
    
    /**
     * Metodo retorna un array con los objetos de ingredientes asociados a la receta
     * 
     */
    public function getIngredientes($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Recetastbl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
