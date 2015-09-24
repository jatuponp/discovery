<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Slider;
use app\models\Article;
use app\components\counter;
use yii\data\Pagination;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actionIndex() {
        $slider = new Slider();
        $news = new Article();
        
        return $this->render('index', ['news' => $news,'slider' => $slider]);
    }
    
    public function actionContent($id) {
        $counter = new \app\components\counter();
        $counter->hitsCounter('site/content', $id);
        
        $model = \app\models\Article::findOne($id);
        
        return $this->render('content', ['model' => $model]);
    }
    
    public function actionSearch() {
        $model = Article::find();
        $search = \Yii::$app->getRequest()->getQueryParam('q');
        if ($search) {
            $model->orWhere('title LIKE :s', [':s' => "%$search%"]);
            $model->orWhere('fulltexts LIKE :s', [':s' => "%$search%"]);
        }
        $model->andWhere(['published' => 1]);
        $model->orderBy('ordering');
        $model->limit(10);
        $res = $model->all();
        return $this->render('search', ['model' => $res, 'search' => $search]);
    }
    
    public function actionView($id) {
        $counter = new counter();
        $counter->hitsCounter('site/view', $id);

        $model = Article::findOne(['id' => $id]);
        $article = new Article;
        return $this->render('view', ['model' => $model, 'article' => $article]);
    }

    public function actionViewall($cid = 2) {
        $query = Article::find()->where(['cid' => $cid,'published' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy('ordering')
                ->all();
        
        $cat = \app\models\Categories::findOne($cid);

        return $this->render('viewall', [
                    'model' => $models,
                    'cat' => $cat,
                    'pages' => $pages,
        ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
            
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

}
