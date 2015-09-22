<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\social\FacebookPlugin;
use app\components\Ndate;
use app\components\counter;

/**
 * @var yii\web\View $this
 */
$this->title = $model->title;
$ndate = new Ndate();
$counter = new counter();
$this->registerMetaTag(['description' => $model->title]);
?>
<!-- Page Title
============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1><a href="<?= Url::to(['gallery/index']) ?>"><?= Yii::t('app', 'Gallery') ?></a></h1>
        <span><?= Html::encode($this->title) ?></span>
    </div>

</section><!-- #page-title end -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="postcontent nobottommargin clearfix">
                <div class="row">
                    <div class="row" style="padding-right: 15px;">                       

                        <p>
                            <?= $model->description ?>
                        </p>
                        <div class="clearfix"></div>    
                        <?php
                        $mPath = \Yii::getAlias('@webroot') . '/images/gallery/cat_' . $model->id;
                        $mUrl = \Yii::getAlias('@web') . '/images/gallery/cat_' . $model->id;
                        if (!is_dir($mPath)) {
                            mkdir($mPath);
                            chmod($mPath, '777');
                        }
                        foreach (scandir($mPath) as $img) {
                            if ($img != '.' && $img != '..' && $img != 'thumb') {
                                $mThumb = $mUrl . '/thumb/' . $img;
                                //ตรวจสอบภาพตัวอย่าง ว่าถูกสร้างขึ้นมาหรือยัง
                                if (!file_exists($mThumb)) {
                                    //ตรวจสอบโฟลเดอร์ภาพตัวอย่าง
                                    if (!is_dir($mPath . '/thumb')) {
                                        mkdir($mPath . '/thumb/');
                                        chmod($mPath . '/thumb/', '777');
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
                            //echo "ภาพประกอบ";
                            echo dosamigos\gallery\Gallery::widget(['items' => $items]);
                        }
                        ?>
                        <div class="clearfix"></div>
                        <div style="margin-bottom: 10px;">
                            <button class="btn btn-default disabled"><i class="glyphicon glyphicon-calendar"></i><?= $ndate->getThaiLongDate($model->applydate) ?></button> 
                            <button class="btn btn-default disabled"><i class="glyphicon glyphicon-eye-open"></i><?= $counter->getHitsCounter('gallery/view', $model->id) ?> Views</button>
                        </div><div class="clearfix"></div>
                        <hr/>
                        <?php
//                $social = Yii::$app->getModule('social');
//
//                echo FacebookPlugin<hr/>::widget(['type' => FacebookPlugin::LIKE, 'settings' => ['share' => 'true', 'width' => '500px','href'=> Yii::$app->urlManager->createAbsoluteUrl(['gallery/view','id'=>$model->id])]]);
//                echo FacebookPlugin::widget(['type' => FacebookPlugin::COMMENT, 'settings' => ['width'=>'100%','href'=> Yii::$app->urlManager->createAbsoluteUrl(['gallery/view','id'=>$model->id])]]);
                        ?>
                    </div>                        
                </div>
            </div>
            <div class="sidebar nobottommargin col_last clearfix">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <h4><?= Yii::t('app', 'More') ?></h4>
                        <ul class="gallery-list">
                            <?php
                            $gal = $gallery->lists($model->amphur, 6);
                            foreach ($gal as $g) {
                                $mPath = \Yii::getAlias('@webroot') . '/images/gallery/cat_' . $g->id;
                                $mUrl = \Yii::getAlias('@web') . '/images/gallery/cat_' . $g->id;
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
                                <li>
                                    <a href="<?= Url::to(['gallery/view', 'id' => $g->id]) ?>">
                                        <img src="<?= $mThumb ?>" width="100px" height="65" style="margin-right: 5px; float: left;" />
                                        <?= $g->title ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

