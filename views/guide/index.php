<?php

use yii\helpers\Url;
use app\components\Ndate;
use app\components\Ncontent;
use yii\widgets\LinkPager;
?>
<!-- Page Title
                ============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>ข้อมูลแหล่งท่องเที่ยวจังหวัดหนองคาย</h1>
        <span><?= app\models\TblGuides::getCat($cid) ?></span>
    </div>

</section><!-- #page-title end -->

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <!-- Post Content
            ============================================= -->
            <div class="postcontent nobottommargin clearfix">
                <!-- Posts
                ============================================= -->
                <div id="posts" class="small-thumbs">
                    <?php
                    foreach ($model as $r) {
                        $d = new Ndate();
                        $cont = new Ncontent($r->fulltexts);
                        ?>
                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="<?= $cont->getImg() ?>" data-lightbox="image"><img class="image_fade" src="<?= $cont->getImg() ?>"></a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2><a href="<?= Url::to(['guide/view', 'id' => $r->id]) ?>"><?= $r->titles ?></a></h2>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i> <?= $d->getThaiLongDate($r->applyDate) ?></li>
                                    <li><i class="icon-user"></i> admin</li>
                                    <li><i class="icon-comments"></i> 13 Views</li>
                                </ul>
                                <div class="entry-content">
                                    <?php
                                    if ($cont->getLimitText()) {
                                        ?>
                                        <p><?= $cont->getLimitText() ?></p>
                                        <?php } else {
                                        ?>
                                        <p>
                                            <?= $r->address ?><br/>
                                            Contact: (Phone) <?= $r->phone ?> (fax) <?= $r->fax ?><br/>
                                            Website: <a href="<?= $r->website ?>" target="_blank"><?= $r->website ?></a>
                                        </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    // display pagination
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
