<?php

use yii\helpers\Html;
use app\components\Ncontent;
use app\components\counter;
use app\components\Ndate;
use yii\helpers\Url;

//use kartik\social\GoogleAnalytics;
//echo GoogleAnalytics::widget(['objectName' => 'ga']);

$this->title = $model->title;
$this->registerMetaTag(['description' => $model->title]);
$counter = new counter();
$ndate = new Ndate();
?>
<section id="page-title">

    <div class="container clearfix">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

</section><!-- #page-title end -->
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
            <div class="postcontent nobottommargin clearfix">
                <div style="margin-bottom: 10px;">
                    <button class="btn btn-default disabled"><i class="glyphicon glyphicon-calendar"></i> <?= $ndate->getThaiLongDate($model->applydate) ?></button> 
                    <button class="btn btn-default disabled"><i class="glyphicon glyphicon-eye-open"></i> <?= $counter->getHitsCounter('site/view', $model->id) ?> Views</button>
                </div>
                <div>
                    <?= $model->fulltexts ?>
                </div>
                <div class="clearfix"></div>
                <br/>             
                <?php
                $mPath = \Yii::getAlias('@webroot') . '/images/article/news_' . $model->id;
                $mUrl = \Yii::getAlias('@web') . '/images/article/news_' . $model->id;
                if (!is_dir($mPath)) {
                    \yii\helpers\BaseFileHelper::createDirectory($mPath);
                }
                foreach (scandir($mPath) as $img) {
                    if ($img != '.' && $img != '..' && $img != 'thumb') {
                        $mThumb = $mUrl . '/thumb/' . $img;
                        //ตรวจสอบภาพตัวอย่าง ว่าถูกสร้างขึ้นมาหรือยัง
                        if (!file_exists($mThumb)) {
                            //ตรวจสอบโฟลเดอร์ภาพตัวอย่าง
                            if (!is_dir($mPath . '/thumb')) {
                                \yii\helpers\BaseFileHelper::createDirectory($mPath . '/thumb/');
                            }
                            //สร้างภาพตัวอ่ย่าง
                            $image = \Yii::$app->image->load($mPath . '/' . $img);
                            $image->resize(130, 130);
                            $image->save($mPath . '/thumb/' . $img);
                        }
                        $items[] = [
                            'url' => $mUrl . '/' . $img,
                            'src' => $mThumb,
//                        'options' => array('height' => '150px')
                        ];
                    }
                }
                ?>
                <?php
                if (count($items) > 0) {
                    echo "ภาพประกอบ";
                    echo dosamigos\gallery\Gallery::widget(['items' => $items]);
                }
                ?>
            </div>
            <div class="sidebar nobottommargin col_last clearfix">
                <div class="sidebar-widgets-wrap">
                    <div class="row">
                        <br/>
                        <div class="gallery-header" style="text-align: right; border-bottom: 2px solid #ccc;"><?= Yii::t('app', 'News More') ?> </div>
                        <ul class="gallery-list">
                            <?php
                            $news = $article->news($model->cid, 10);
                            for ($i = 1, $n = count($news); $i < $n; $i++) {
                                $data = $news[$i];
                                $cont = new Ncontent($data->fulltexts);
                                ?>
                                <li>
                                    <a href="<?= Url::to(['site/view', 'id' => $data->id]) ?>">
                                        <div style="width: 120px; float: left; margin-right: 5px;">
                                            <img src="<?= $cont->getImg() ?>" />
                                        </div>
                                        <?= $cont->getLimitText('70', $data->title) ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <?= Html::a(Yii::t('app', 'News More'), Url::to(['site/viewall', 'cid' => $model->cid]), ['class' => 'btn btn-danger pull-right', 'style' => 'color:#ffffff;']) ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>