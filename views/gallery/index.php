<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Ndate;
use app\components\counter;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 */
$this->title = 'Gallery';
$ndate = new Ndate();
$counter = new counter();
$this->registerMetaTag(['description' => $model->title]);
?>
<!-- Page Title
============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1><?= Yii::t('app', 'Gallery') ?></h1>
<!--        <span><?= Html::encode($this->title) ?></span>-->
    </div>

</section><!-- #page-title end -->

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-4">
                    
                </div>
                <div class="col-lg-8">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'article-form',
                                'options' => [ 'class' => 'form-inline pull-right'],
                                'fieldConfig' => [
                                    'template' => "{label}{input}",
                                    'labelOptions' => [ 'class' => 'sr-only'],
                                ],
                    ]);
                    ?>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12">
                            <?= $form->field($model, 'amphur')->dropDownList(\app\models\TblAmphur::makeDropDown(), [ 'style' => 'margin-right: 10px; width: 250px;', 'onchange' => 'form.submit();']) ?>
                            <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> ค้นหา', [ 'class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div><br/>
            <?php
            $i = 1;
            foreach ($list as $l) :
                if ($i % 6 == 0) {
                    echo '<div class="row">';
                }
                $mPath = \Yii::getAlias('@webroot') . '/images/gallery/cat_' . $l->id;
                $mUrl = \Yii::getAlias('@web') . '/images/gallery/cat_' . $l->id;
                if (!is_dir($mPath)) {
                    mkdir($mPath);
                    chmod($mPath, '777');
                }
                foreach (scandir($mPath) as $img) {
                    if ($img != '.' && $img != '..' && $img != 'thumb') {
                        $mThumb = $mUrl . '/thumb/' . $img;
                    }
                }
                ?>
                <div class="col-sm-6 col-sm-2">
                    <a href="<?= Url::to(['gallery/view', 'id' => $l->id]) ?>"class="thumbnail">
                        <div >
                            <img src="<?= $mThumb ?>" width="100%"/>
                            <div class="caption">
                                <h4><?= $l->title ?></h4>                            
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                if ($i % 6 == 0) {
                    echo '</div>';
                }
                $i++;
            endforeach;
            ?>
            <div class="clearfix"></div>


            <?php
            // display pagination
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
    </div>
</section>