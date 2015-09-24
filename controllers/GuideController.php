<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TblGuides;
use yii\data\Pagination;

class GuideController extends Controller {

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

    public function actionIndex($cid = 1) {
        $search = new TblGuides();        
        $langs = \app\components\langs::getLang();
        $query = TblGuides::find()->where(['cid' => $cid, 'langs' => $langs, 'published' => 1]);
        $amp = Yii::$app->getRequest()->getQueryParam('amp');
        if($amp){
            $query->andWhere(['amphur' => $amp]);
        }
        if($search->load(Yii::$app->request->post())){
            $request = Yii::$app->request->post('TblGuides');
            $s = $request['search'];
            //$query->orWhere([['LIKE', 'titls', "%$s%"],['LIKE', 'fulltexts', "%$s%"]]);
            //$query->orWhere('LIKE', 'titles', "%$s%");
            $query->andFilterWhere(['or',['like','titles',$s],['like','fulltexts',$s]]);
        }
        $query->orderBy('rand()');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 10]);
        $list = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', ['search' => $search, 'model' => $list, 'cid' => $cid, 'pages' => $pages]);
    }
    
    public function actionView($id) {
        $counter = new \app\components\counter();
        $counter->hitsCounter('guide/view', $id);
        
        $model = TblGuides::findOne($id);
        $Attractions = TblGuides::find()->where(['cid' => $model->cid, 'published' => 1, 'langs' => $model->langs])->limit(10)->orderBy('rand()')->all();
        
        return $this->render('view', ['model' => $model, 'Attractions' => $Attractions]);
    }
    
    public function actionData() {
        
//        $result = \app\models\WebFoo::find()->all();
//        foreach ($result as $r){
//            $m = new TblGuides();
//            $m->cid = 3;
//            $m->titles = $r->titles;
//            $m->address = $r->address;
//            $m->tampon = $r->tampon;
//            $m->amphur = $r->amphur;
//            $m->gps = $r->gps;
//            $m->distance = $r->distance;
//            $m->fulltexts = (($r->fulltexts)? $r->fulltexts:'-');
//            $m->contacts = $r->contacts;
//            $m->phone = $r->phone;
//            $m->fax = $r->fax;
//            $m->emails = $r->emails;
//            $m->website = $r->website;
//            $m->langs = $r->langs;
//            $m->published = 1;
//            $m->applyDate = $r->applyDate;
//            if(!$m->save()){
//                print_r($m->getErrors());
//                exit();
//            }
//        }
        
    }

}
