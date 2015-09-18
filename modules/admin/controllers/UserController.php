<?php

namespace app\modules\admin\controllers;

use app\models\User;
use yii\filters\AccessControl;

\Yii::$app->name = '<i class="glyphicon glyphicon-user"></i> บริหารข้อมูลผู้ใช้';

class UserController extends \yii\web\Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['Administrator'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $model = new User;
        return $this->render('index', ['model' => $model]);
    }

}
