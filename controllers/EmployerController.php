<?php

namespace app\controllers;

use app\models\Employer;
use app\models\EmployerSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use yii\data\ActiveDataProvider;

class EmployerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'store', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'store', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if (!User::isUserAdmin(Yii::$app->user->identity->username)) {
                                Yii::$app->getSession()->setFlash('auth', 'You can not access employer page.');
                                return $this->goHome();
                            };
                            return true;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'store' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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
    public function actionIndex()
    {
        $searchModel = new EmployerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionCreate()
    {
        $model = new Employer();
        if (Yii::$app->request->post()) {
            $wkt = explode('-', Yii::$app->request->post()['Employer']['join_date']);
            $time = $wkt[2] . '-' . $wkt[1] . '-' . $wkt[0];
            if ($model->load(Yii::$app->request->post())) {
                $model->join_date = $time;
                $model->save();
                Yii::$app->getSession()->setFlash('success', 'Success add employer into database');
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionUpdate($id_employer)
    {
        $model = Employer::findOne($id_employer);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $wkt = explode('-', Yii::$app->request->post()['Employer']['join_date']);
            $time = $wkt[2] . '-' . $wkt[1] . '-' . $wkt[0];
            $model->join_date = $time;
            $model->save();
            return $this->redirect(['view', 'id_employer' => $model->id_employer]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionDelete($id_employer)
    {
        $model = Employer::findOne($id_employer);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionView($id_employer)
    {
        return $this->render('view', [
            'model' => Employer::findOne($id_employer),
        ]);
    }
}
