<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'เข้าสู่ระบบ';
?>
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="col-sm-7">
                <img src="<?php echo Yii::getAlias('@web'); ?>/images/frontgallery/river01.jpg" width="100%" />
            </div>
            <div class="col-sm-5">
                <h1><?= Html::encode($this->title) ?></h1>

                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                ]);
                ?>

                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width: 150px;']) ?>

                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>