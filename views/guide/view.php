<?php

use yii\helpers\Url;
use app\components\Ndate;
use app\components\Ncontent;
use yii\widgets\LinkPager;

$d = new Ndate();
?>
<!-- Page Title
                ============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>แหล่งท่องเที่ยวจังหวัดหนองคาย</h1>
        <span>หมวด: <?= app\models\TblGuides::getCat($model->cid) ?></span>
    </div>

</section><!-- #page-title end -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="postcontent nobottommargin clearfix">
                <h4><?= $model->titles ?></h4>
                <ul class="entry-meta clearfix">
                    <li><i class="icon-calendar3"></i> <?= $d->getThaiLongDate($model->applyDate) ?></li>
                    <li><i class="icon-user"></i> admin</li>
                    <li><i class="icon-comments"></i> 13 Views</li>
                </ul>

                <div class="fslider" data-arrows="false" data-animation="fade" data-thumbs="true">
                    <div class="flexslider">
                        <div class="slider-wrap">
                            <?php
                            $cont = new Ncontent($model->fulltexts);
                            $aImg = $cont->getAllImg();
                            $i = 1;
                            foreach ($aImg[1] as $img) {
                                ?>
                                <div class="slide" data-thumb="<?= Yii::getAlias('@web') . '/' . $img ?>"><img src="<?= Yii::getAlias('@web') . '/' . $img ?>"></div>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                    <p><?= $cont->getTextRemoveImg() ?></p>
                </div>

                <div class="line"></div>
            </div>

            <!-- Sidebar
            ============================================= -->
            <div class="sidebar nobottommargin col_last clearfix">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
                        <h4><?= Yii::t('app', 'Location') ?></h4>
                        <?= $model->address ?><br/>
                        Contact: (Phone) <?= $model->phone ?> (fax) <?= $model->fax ?><br/>
                        Website: <a href="<?= $model->website ?>" target="_blank"><?= $model->website ?></a>
                    </div>
                    <div class="widget clearfix">
                        <h4><?= Yii::t('app', 'Tourist Attraction') ?></h4>
                        <div>
                            <?php
                            foreach ($Attractions as $r) {
                                $cont = new Ncontent($r->fulltexts);
                                $img = Yii::getAlias('@webroot') . '/' . $cont->getImg();
                                if($cont->getImg()){
                                ?>
                                <div class="">
                                    <a href="<?= Url::to(['guide/view', 'id' => $r->id]) ?>"><img src="<?= Yii::getAlias('@web') . '/' . $cont->getImg() ?>" /></a>
                                    <div class="portfolio-desc center nobottompadding">
                                        <h5><?= $r->titles ?></h5>
                                    </div>
                                </div>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>