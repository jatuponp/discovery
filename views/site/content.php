<?php

use yii\helpers\Url;
use app\components\Ndate;
use app\components\counter;
$d = new Ndate();
$count = new counter();
$this->title = $model->title;
$this->registerMetaTag(['description' => $model->title]);
?>
<section id="page-title">

    <div class="container clearfix">
        <h1>ข้อมูลการท่องเที่ยว</h1>
        <span>จังหวัดหนองคาย</span>
    </div>

</section><!-- #page-title end -->
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="single-post nobottommargin">

                <!-- Single Post
                ============================================= -->
                <div class="entry clearfix">

                    <!-- Entry Title
                    ============================================= -->
                    <div class="entry-title">
                        <h2><?= $model->title ?></h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> <?= $d->getThaiLongDate($model->applydate) ?></li>
                        <li><a href="#"><i class="icon-user"></i> admin</a></li>
                        <li><a href="#"><i class="icon-comments"></i> <?= $count->getHitsCounter('site/content', $model->id) ?> Views</a></li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Content
                    ============================================= -->
                    <div class="entry-content notopmargin">
                        <?= $model->fulltexts ?>

                    </div>
                </div><!-- .entry end -->
            </div>
        </div>
    </div>
</section>