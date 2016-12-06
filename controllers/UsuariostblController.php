<?php

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

        if ($model->load(Yii::$app->request->post())) {
            $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $model->password = $hash;
            $model->save();
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

        return $this->redirect(['index']);
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
