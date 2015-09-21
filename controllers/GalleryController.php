<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\tblGallery;
use app\components\counter;
use yii\data\Pagination;

class GalleryController extends Controller {

    public function actionIndex() {
        $langs = \app\components\langs::getLang();
        $model = new tblGallery();
        $query = tblGallery::find()->where(['langs' => $langs, 'published' => 0]);
        if ($model->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->post('tblGallery');
            $query->andWhere(['amphur' => $request['amphur']]);
        }
        $query->orderBy('rand()');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 30]);
        $list = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', ['model' => $model, 'list' => $list, 'pages' => $pages]);
    }

    public function actionView($id) {
        $counter = new counter();
        $counter->hitsCounter('gallery/view', $id);

        $model = tblGallery::findOne($id);
        $gallery = new tblGallery;

        return $this->render('view', ['model' => $model, 'gallery' => $gallery]);
    }

}
