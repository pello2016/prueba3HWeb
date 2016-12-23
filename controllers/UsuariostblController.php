<?php
//Solo se modifico el "update" faltan los demas

namespace app\controllers;

use Yii;
use app\models\Usuariostbl;
use app\models\UsuariostblSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UsuariostblController implements the CRUD actions for Usuariostbl model.
 */
class UsuariostblController extends Controller
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
     * Lists all Usuariostbl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariostblSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuariostbl model.
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
     * Creates a new Usuariostbl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuariostbl();
        //se crea una variable items, en la que se guardaran los roles de la tabla
        $items = ArrayHelper::map(\app\models\Rolestbl::find()->all(), 'id', 'rol');

        if ($model->load(Yii::$app->request->post())) {
            //si la vista se carga mediante post (el usuario presiono el boton submit)
            //se creara una variable hash en la que se generara una clave encriptada
            $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            //luego, se le dice a la clave del modelo que sea igual a la clave encriptada
            $model->password = $hash;
            //finalmente, se guarda en la bd y se redirige a la vista de detalles
            $model->save();
            
            //ahora se debe asignar el rol yii al usuario recien creado.
            $auth = Yii::$app->authManager;
            $rolNuevo = \app\models\Rolestbl::findOne($model->rolestbl_id);
            $rolNuevoYii = $auth->getRole($rolNuevo->rol);
            $auth->assign($rolNuevoYii, $model->id);
            //se completa la asignacion de rol al usuario nuevo.
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //si no, la llamada es mediante get, por lo que debe renderizar la vista
            //con todos los elementos correspondientes al modelo, y adicionalmente
            //el arreglo de items que creamos previamente
            return $this->render('create', [
                'model' => $model,
                'items' => $items
            ]);
        }
    }

    /**
     * Updates an existing Usuariostbl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //en modificar se aplica el mismo principio de crear
        $model = $this->findModel($id);
        $items = ArrayHelper::map(\app\models\Rolestbl::find()->all(), 'id', 'rol');
        
        //rol anterior
        $rolAnterior = $model->rolestbl_id;

        if ($model->load(Yii::$app->request->post())) {
            //solucionado el problema del re-hash de la password actual
            //si no se modificaba, se volvia a hashear, lo que es malo (?)
            //
            //para solucionar esto, fue necesario preguntar a la bd por el
            //hash del usuario el cual se esta modificando mediante el id
            $user = Usuariostbl::findOne($id);
            $hash = $user->password;
            
            if ($model->password != $hash){
                //luego, si la pass del form es distinta a la de la bd, se procede
                //a hashear la nueva pass, y se le dice al form que la password
                //sera el hash de la misma
                $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $model->password = $hash;
            }
            else{
                //caso contrario, se mantiene la password hasheada actual y se guardan
                //los cambios que pudieran haberse hecho
                $model->save();
            }
            
	    //inicio codigo
            //Codigo para actualizar rol en las tablas de Yii2
            $auth = Yii::$app->authManager;
            
            $rolAnt = \app\models\Rolestbl::findOne($rolAnterior);
            $rolAntYii = $auth->getRole($rolAnt->rol);
            $auth->revoke($rolAntYii,$model->id);
            ////quita el rol asignado al usuario que se esta actualizando
            //Si se desea quitar todos los roles que tenga asignados previamente se usa:
            //$auth->revokeAll($model->id);
            
            $rolNuevo = \app\models\Rolestbl::findOne($model->rolestbl_id);
            $rolNuevoYii = $auth->getRole($rolNuevo->rol);
            $auth->assign($rolNuevoYii, $model->id);
            //fin codigo
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'items' => $items
            ]);
        }
    }

    /**
     * Deletes an existing Usuariostbl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $searchModel = new UsuariostblSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Usuariostbl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuariostbl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuariostbl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
