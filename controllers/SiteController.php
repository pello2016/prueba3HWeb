<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Usuariostbl;
use app\models\Rolestbl;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','logout','contact','about','editSelf'],
                        'roles' => ['administrador','usuario'],
                    ], 
                    [
                        'actions' => ['login','register'],
                        'allow' => true, 
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }
    
    // ***** NUEVO ******
    //codigo para añadir roles
    //Solo se usa aqui cuando los roles han sido creados previamente, antes de
    //la implementacion de este sistema.
    //Lo ideal es que los roles se "creen" al momendo de usar el CRUD de Rolestbl

    /*
      public function actionRoles() {
      //cada vez que se cree un rol en la base de datos se debe ejecutar este codigo.
      $auth = Yii::$app->authManager;
      $roles = Rolestbl::find()->all();
      foreach ($roles as $rol) {

      try {
      $rolAuth = $auth->createRole($rol->rol);
      $auth->add($rolAuth);
      echo 'rol: ' .$rol->rol;

      } catch (Exception $ex) {

      }
      }
      }
     */
    //FIN ***** NUEVO *****

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    /**
     * Register a new Usuariostbl model.
     * If creation is successful, the browser will be redirected to the 'login' page.
     * @return mixed
     */
    public function actionRegister()
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
            
            return $this->redirect(['login']);
        }
        else {
            //si no, la llamada es mediante get, por lo que debe renderizar la vista
            //con todos los elementos correspondientes al modelo, y adicionalmente
            //el arreglo de items que creamos previamente
            return $this->render('register', [
                'model' => $model,
                'items' => $items
            ]);
        }
    }

    /**
     * Updates the current user's data model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditself($id)
    {
        //en modificar se aplica el mismo principio de crear
        $model = Usuariostbl::findOne($id);
        $items = ArrayHelper::map(\app\models\Rolestbl::find()->all(), 'id', 'rol');
        
        //rol anterior
        $rolAnterior = $model->rolestbl_id;

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            
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
            
            return $this->redirect(['usuariostbl/view', 'id' => $model->id]);
        }
        else {
            return $this->render('editself', [
                'model' => $model,
                'items' => $items
            ]);
        }
    }
    
    public function actionEditselfpass($id)
    {
        $model = Usuariostbl::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $user = Usuariostbl::findOne($id);
            $hash = $user->password;
            
            if ($model->password != $hash){
                $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $model->password = $hash;
            }
            $model->save();

            return $this->redirect(['editself', 'id' => $model->id]);
        }
        else {
            return $this->render('editselfpass', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

}
