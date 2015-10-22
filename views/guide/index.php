<?php

use yii\helpers\Url;
use app\components\Ndate;
use app\components\Ncontent;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\counter;
$count = new counter();
?>
<!-- Page Title
                ============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1><?= Yii::t('app', 'Tourist Information') ?></h1>
        <span><?= Yii::t('app', app\models\TblGuides::getCat($cid)) ?></span>
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
                                <?php if ($cont->getImg()) : ?>
                                    <a href="<?= $cont->getImg() ?>" data-lightbox="image"><img class="image_fade" src="<?= $cont->getImg() ?>"></a>
                                <?php else: ?>
                                    <img class="image_fade" src="<?= Yii::getAlias('@web') . '/images/emptyImg.png' ?>">
                                <?php endif; ?>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2><a href="<?= Url::to(['guide/view', 'id' => $r->id]) ?>"><?= $r->titles ?></a></h2>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i> <?= $d->getThaiLongDate($r->applyDate) ?></li>
                                    <li><i class="icon-user"></i> admin</li>
                                    <li><i class="icon-comments"></i> <?= $count->getHitsCounter('guide', $r->id) ?> Views</li>
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

            <div class="sidebar nobottommargin col_last clearfix">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix">
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
                                <?= $form->field($search, 'search')->input('text', [ 'style' => 'width: 200px']); ?>
                                <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> '.Yii::t('app', 'Search'), [ 'class' => 'btn btn-danger']) ?>
                            </div>
                        </div>


                        <?php ActiveForm::end(); ?>
                        <h4><?= Yii::t('app', 'Amphoe') ?></h4>
                        <div class="tagcloud">
                            <?php
                                $ams = \app\models\TblAmphur::find()->all();
                                foreach ($ams as $a){
                                    echo '<a href="'. Url::to(['/guide/', 'cid'=>  Yii::$app->getRequest()->getQueryParam('cid'), 'amp' => $a->id]) .'">' . ((Yii::$app->language == 'th_TH')? $a->names:$a->names_eng) . '</a>';
                                }
                            ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
