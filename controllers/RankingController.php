<?php

namespace app\controllers;

use Yii;
use app\models\Ranking;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * RankingController doesn't implements any CRUD actions for Ranking model.
 */
class RankingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['administrador','usuario'],
                    ], 
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * Show Ranking Index.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
