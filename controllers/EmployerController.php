<?php

namespace app\controllers;

use app\models\Companies;
use app\models\Employer;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

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
                'only' => ['create', 'update', 'store', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'store', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if (!User::isUserAdmin(Yii::$app->user->identity->username)) return $this->goHome();
                            return true;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Employer::find(),
            'pagination' => [
                'pageSize' => 2
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_company' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
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
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionStore()
    {
        $model = new Employer();
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Success add company into database');
                return $this->redirect(['index']);
            }
            // $model->logo_company = UploadedFile::getInstance($model, 'logo_company');

            // if ($model->logo_company && $model->validate()) {
            //     $fileNameup = $model->logo_company->baseName . time() . '.' . $model->logo_company->extension;
            //     $model->logo_company->saveAs('uploads/' . $fileNameup);
            //     $model->logo_company = $fileNameup;
            //     $model->save();
            //     Yii::$app->getSession()->setFlash('success', 'Success add company into database');
            //     return $this->redirect(['index']);
            // }
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionUpdate($id_employer)
    {
        $model = Employer::findOne($id_employer);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
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
