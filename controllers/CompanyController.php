<?php

namespace app\controllers;

use app\models\Companies;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class CompanyController extends Controller
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
                                Yii::$app->getSession()->setFlash('auth', 'You can not access.');
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
                                Yii::$app->getSession()->setFlash('auth', 'You can not access.');
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
        $dataProvider = new ActiveDataProvider([
            'query' => Companies::find(),
            'pagination' => [
                'pageSize' => 2
            ],
            'sort' => [
                'defaultOrder' => [
                    'name_company' => SORT_ASC,
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
        $model = new Companies();
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionStore()
    {
        $model = new Companies();
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post())) {
                $model->file_image = UploadedFile::getInstance($model, 'file_image');
                if ($model->file_image) {
                    $namafile = time() . $model->file_image->baseName . '-img.' . $model->file_image->extension;
                    $model->logo_company = $namafile;
                }
                $model->save();
                $model->file_image = UploadedFile::getInstance($model, 'file_image');
                if ($model->file_image) {
                    $model->file_image->saveAs('uploads/' . $namafile);
                }
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
    public function actionUpdate($id_company)
    {
        $model = Companies::findOne($id_company);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_company' => $model->id_company]);
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
    public function actionDelete($id_company)
    {
        $model = Companies::findOne($id_company);
        if ($model->logo_company || $model->logo_company != '') {
            unlink('uploads/' . $model->logo_company);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionView($id_company)
    {
        return $this->render('view', [
            'model' => Companies::findOne($id_company),
        ]);
    }
}
