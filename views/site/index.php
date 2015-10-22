<?php
/* @var $this yii\web\View */
$this->title = 'NongKhai Discovery แหล่งท่องเที่ยว จังหวัดหนองคาย สถานที่ท่องเที่ยว ที่พัก โรงแรม รีสอร์ท ร้านอาหาร';
$jsScript = <<<EOD
    var swiperSlider = new Swiper('.swiper-parent', {
    paginationClickable: false,
    slidesPerView: 1,
    grabCursor: true,
    loop: true,
    onSwiperCreated: function (swiper) {
        $('[data-caption-animate]').each(function () {
            var toAnimateElement = $(this);
            var toAnimateDelay = $(this).attr('data-caption-delay');
            var toAnimateDelayTime = 0;
            if (toAnimateDelay) {
                toAnimateDelayTime = Number(toAnimateDelay) + 750;
            } else {
                toAnimateDelayTime = 750;
            }
            if (!toAnimateElement.hasClass('animated')) {
                toAnimateElement.addClass('not-animated');
                var elementAnimation = toAnimateElement.attr('data-caption-animate');
                setTimeout(function () {
                    toAnimateElement.removeClass('not-animated').addClass(elementAnimation + ' animated');
                }, toAnimateDelayTime);
            }
        });
        SEMICOLON.slider.swiperSliderMenu();
    },
    onSlideChangeStart: function (swiper) {
        $('[data-caption-animate]').each(function () {
            var toAnimateElement = $(this);
            var elementAnimation = toAnimateElement.attr('data-caption-animate');
            toAnimateElement.removeClass('animated').removeClass(elementAnimation).addClass('not-animated');
        });
        SEMICOLON.slider.swiperSliderMenu();
    },
    onSlideChangeEnd: function (swiper) {
        $('#slider').find('.swiper-slide').each(function () {
            if ($(this).find('video').length > 0) {
                $(this).find('video').get(0).pause();
            }
            if ($(this).find('.yt-bg-player').length > 0) {
                $(this).find('.yt-bg-player').pauseYTP();
            }
        });
        $('#slider').find('.swiper-slide:not(".swiper-slide-active")').each(function () {
            if ($(this).find('video').length > 0) {
                if ($(this).find('video').get(0).currentTime != 0)
                    $(this).find('video').get(0).currentTime = 0;
            }
            if ($(this).find('.yt-bg-player').length > 0) {
                $(this).find('.yt-bg-player').getPlayer().seekTo($(this).find('.yt-bg-player').attr('data-start'));
            }
        });
        if ($('#slider').find('.swiper-slide.swiper-slide-active').find('video').length > 0) {
            $('#slider').find('.swiper-slide.swiper-slide-active').find('video').get(0).play();
        }
        if ($('#slider').find('.swiper-slide.swiper-slide-active').find('.yt-bg-player').length > 0) {
            $('#slider').find('.swiper-slide.swiper-slide-active').find('.yt-bg-player').playYTP();
        }

        $('#slider .swiper-slide.swiper-slide-active [data-caption-animate]').each(function () {
            var toAnimateElement = $(this);
            var toAnimateDelay = $(this).attr('data-caption-delay');
            var toAnimateDelayTime = 0;
            if (toAnimateDelay) {
                toAnimateDelayTime = Number(toAnimateDelay) + 300;
            } else {
                toAnimateDelayTime = 300;
            }
            if (!toAnimateElement.hasClass('animated')) {
                toAnimateElement.addClass('not-animated');
                var elementAnimation = toAnimateElement.attr('data-caption-animate');
                setTimeout(function () {
                    toAnimateElement.removeClass('not-animated').addClass(elementAnimation + ' animated');
                }, toAnimateDelayTime);
            }
        });
    }
    });

    $('#slider-arrow-left').on('click', function (e) {
    e.preventDefault();
    swiperSlider.swipePrev();
    });

    $('#slider-arrow-right').on('click', function (e) {
    e.preventDefault();
    swiperSlider.swipeNext();
    });
EOD;
$this->registerJs($jsScript);

$slide = $slider->slider();
?>
<section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix">

    <div class="swiper-container swiper-parent">
        <div class="swiper-wrapper">
            <?php
            $i = 1;
            foreach ($slide as $s) {
                ?>
                <div class="swiper-slide dark" style="background-image: url('<?= $s->slider_Url ?>'); background-position: center top;">
                    <div class="container clearfix">
                        <div class="slider-caption <?= (($s->positions == 'center') ? 'slider-caption-center' : '') ?> <?= (($s->positions == 'right') ? 'slider-caption-right' : '') ?>">
                            <h2 data-caption-animate="fadeInUp"><?= $s->title ?></h2>
                            <p data-caption-animate="fadeInUp" data-caption-delay="200"><?= $s->fulltexts ?></p>
                            <?php
                            if ($s->link_Url) {
                                ?>
                                <a style="min-height: 0px; min-width: 0px; line-height: 42px; border-width: 2px; margin: 0px; padding: 0px 26px; letter-spacing: 1px; font-size: 16px;" href="<?= $s->link_Url ?>" class="button button-border button-white button-light button-large button-rounded tright nomargin"><span style="min-height: 0px; min-width: 0px; line-height: 42px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 1px; font-size: 16px;">อ่านเพิ่มเติม</span> <i style="min-height: 0px; min-width: 0px; line-height: 16px; border-width: 0px; margin: 0px 0px 0px 5px; padding: 0px; letter-spacing: 1px; font-size: 16px;" class="icon-angle-right"></i></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>                
        </div>
        <div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
        <div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
    </div>
    <a href="#" data-scrollto="#content" data-offset="100" class="dark one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a>

</section>

<!-- Content
            ============================================= -->
<section id="content">

    <div class="content-wrap">
        <div class="container clearfix">

        <?php
        $Welcome = app\models\Article::find()->where(['cid' => 11, 'published' => 1])->limit(1)->all();
        foreach ($Welcome as $r):
            $cont = new app\components\Ncontent($r->fulltexts);
            $txt = trim($cont->getLimitText());
            $allImg = $cont->getAllImg();
            $secondImg = $allImg[1][1];
            ?>
            <div class="row clearfix">
                <div class="col-lg-6">
                    <div class="topmargin">
                        <h1><?= Yii::t('app', 'Welcome') ?></h1>
                    </div>
                    <p class="lead" style="word-wrap: break-word;"><?= trim($cont->getLimitText(500)) ?> <a href="<?= \yii\helpers\Url::to(['site/view', 'id' => $r->id]) ?>"><?= Yii::t('app', 'More') ?></a></p>
                </div>
                <div class="col-lg-6">
                    <div style="position: relative; margin-bottom: -60px; margin-top: 0px;" class="ohidden" data-height-lg="426" data-height-md="567" data-height-sm="470" data-height-xs="287" data-height-xxs="183">
                        <img src="<?= $cont->getImg() ?>" style="position: absolute; bottom: 0; left: 0;" data-animate="fadeInUp" data-delay="100" alt="">
                        <img src="<?= $secondImg ?>" style="position: absolute; bottom: 0; left: 0;" data-animate="fadeInUp" data-delay="3000" alt="">
                    </div>
                </div>
            </div>
            <br/><br/>
            <div class="divider"><i class="icon-circle center"></i></div>
        <?php endforeach; ?>
        </div>


        <div class="container clearfix">
            <div class="col_full clearfix">
                <h3><a href="<?= \yii\helpers\Url::to(['gallery/index']) ?>"><?= Yii::t('app', 'Gallery') ?></a></h3>
                <div style="margin-right: -1px; position: relative; height: 855.75px;" class="masonry-thumbs col-3" data-big="2" data-lightbox="gallery">
                    <a style="width: 380px; position: absolute; left: 0px; top: 0px;" href="images/frontgallery/02.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/02.jpg"></a>
                    <a style="width: 760px; position: absolute; left: 380px; top: 0px;" href="images/frontgallery/01.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/01.jpg"></a>
                    <a style="width: 380px; position: absolute; left: 0px; top: 285px;" href="images/frontgallery/03.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/03.jpg"></a>
                    <a style="width: 380px; position: absolute; left: 380px; top: 570px;" href="images/frontgallery/04.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/04.jpg"></a>
                    <a style="width: 380px; position: absolute; left: 760px; top: 570px;" href="images/frontgallery/05.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/05.jpg"></a>
                    <a style="width: 380px; position: absolute; left: 0px; top: 570px;" href="images/frontgallery/06.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/06.jpg"></a>
                </div>
            </div>
        </div>

        <div class="container clearfix">
            <div class="col_full clearfix">
                <h3><a href="#"><?= Yii::t('app', 'Clip Videos') ?></a></h3>
                <div id="null" style="margin-right: -1px; position: relative; height: 523.75px;" class="masonry-thumbs col-5" data-big="1" data-lightbox="gallery">
                    <a style="width: 456px; position: absolute; left: 0px; top: 0px;" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/1_1.jpg" alt="Gallery Thumb 1">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 456px; top: 0px; transition-property: opacity, transform; transition-duration: 0.4s; transform: translate3d(0px, 0px, 0px);" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/2.jpg" alt="Gallery Thumb 2">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div>ทดสอบวิดีโอ</div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 684px; top: 0px; transition-property: opacity, transform; transition-duration: 0.4s; transform: translate3d(0px, 0px, 0px);" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/3.jpg" alt="Gallery Thumb 3">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 912px; top: 0px; transition-property: opacity, transform; transition-duration: 0.4s; transform: translate3d(0px, 0px, 0px);" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/4.jpg" alt="Gallery Thumb 4">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 456px; top: 171px;" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/5.jpg" alt="Gallery Thumb 5">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 684px; top: 171px;" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/6.jpg" alt="Gallery Thumb 6">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 912px; top: 171px;" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/7.jpg" alt="Gallery Thumb 7">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <!--                    <a style="width: 228px; position: absolute; left: 0px; top: 342px;" href="http://canvashtml-cdn.semicolonweb.com/images/portfolio/full/9.jpg" data-lightbox="gallery-item">
                                            <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/9.jpg" alt="Gallery Thumb 9">
                                            <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                                        </a>
                                        <a style="width: 228px; position: absolute; left: 228px; top: 342px;" href="http://canvashtml-cdn.semicolonweb.com/images/portfolio/full/10.jpg" data-lightbox="gallery-item">
                                            <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/10.jpg" alt="Gallery Thumb 10">
                                            <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                                        </a>-->
                    <a style="width: 228px; position: absolute; left: 456px; top: 342px;" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/11.jpg" alt="Gallery Thumb 14">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 684px; top: 342px;" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/12.jpg" alt="Gallery Thumb 12">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                    <a style="width: 228px; position: absolute; left: 912px; top: 342px;" href="/discovery/web/images/videos/explore.mp4" data-lightbox="iframe">
                        <img style="opacity: 1;" class="image_fade" src="/discovery/web/images/stories/12-1.jpg" alt="Gallery Thumb 13">
                        <div class="overlay"><div class="overlay-wrap"><i class="icon-youtube-play"></i></div></div>
                    </a>
                </div>
            </div>
        </div>

        <div class="container clear-bottommargin clearfix">
            <div class="row">
                <h3><a href="<?= \yii\helpers\Url::to(['site/viewall']) ?>"><?= Yii::t('app', 'News') ?></a></h3>
                <?php
                foreach ($news->frontNews() as $n):
                    $tent = new app\components\Ncontent($n->fulltexts);
                    ?>
                    <div class="col-md-4 col-sm-6 bottommargin">
                        <div class="ipost clearfix">
                            <div class="entry-image">
                                <a href="<?= \yii\helpers\Url::to(['site/view', 'id' => $n->id]) ?>"><img class="image_fade" src="<?= $tent->getImg() ?>" alt="Image"></a>
                            </div>
                            <div class="entry-title">
                                <h3><a href="<?= \yii\helpers\Url::to(['site/view', 'id' => $n->id]) ?>"><?= $n->title ?></a></h3>
                            </div>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i> <?= $n->applydate ?></li>
                            </ul>
                            <div class="entry-content">
                                <p><?= $tent->getLimitText() ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!--        <div class="container clear-bottommargin clearfix">
                    <div class="clearfix"></div>
                    <div class="row">
                        <h3><a href="<?= \yii\helpers\Url::to(['event/index']) ?>"><?= Yii::t('app', 'Upcomming Events') ?></a></h3><br/>
                        <ol class="timeline">
        <?php
        foreach ($news->eventNews() as $n):
            $con = new app\components\Ncontent($n->fulltexts);
            ?>
                                                <li class="timeline__step done">
                                                    <input class="timeline__step-radio" id="trigger1{{identifier}}" name="trigger{{identifier}}" type="radio">
                        
                                                    <label class="timeline__step-label" for="trigger1{{identifier}}">
                                                        <span class="timeline__step-content">
            <?= date("j M Y", strtotime($n->startdate)) ?>
                                                        </span>
                                                    </label>
                        
                                                    <span class="timeline__step-content" style="padding: 10px;">
                                                        <a href="<?= yii\helpers\Url::to(['site/view', 'id' => $n->id]) ?>">
                                                            <img src="<?= $con->getImg() ?>" style="width: 100%; padding: 15px;"/><br/>
            <?= $n->title ?><br/>
                                                        </a>
                                                        <p style="text-align: left; word-wrap: break-word;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= $con->getLimitText() ?>                                
                                                        </p>
                                                    </span>
                        
                                                    <i class="timeline__step-marker"><?= 'ธ.ค.'//date("M", strtotime($n->startdate))     ?></i>
                                                </li>
        <?php endforeach; ?>                    
                        </ol>                
                    </div>
                    <div class="clearfix"></div>
                    <br/><br/>
                </div>-->

    </div>

</section><!-- #content end -->
