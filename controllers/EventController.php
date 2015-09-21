<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\tblGallery;
use app\components\counter;
use yii\data\Pagination;
use app\models\Article;

class EventController extends Controller {

    public function actionIndex() {
//        $langs = \app\components\langs::getLang();
//        $model = new tblGallery();
//        $query = tblGallery::find()->where(['langs' => $langs, 'published' => 0]);
//        if ($model->load(Yii::$app->request->post())) {
//            $request = Yii::$app->request->post('tblGallery');
//            $query->andWhere(['amphur' => $request['amphur']]);
//        }
//        $query->orderBy('rand()');
//        $countQuery = clone $query;
//        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 30]);
//        $list = $query->offset($pages->offset)
//                ->limit($pages->limit)
//                ->all();
        $model = new Article();

        return $this->render('index', ['model' => $model] );
    }

}
