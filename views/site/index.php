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
            <div class="row clearfix">
                <div class="col-lg-5">
                    <div class="heading-block topmargin">
                        <h1>ยินดีต้อนรับสู่ <br/> จังหวัดหนองคาย</h1>
                    </div>
                    <p class="lead">เมืองน่าอยู่อันดับ 7 ของโลก</p>
                </div>
                <div class="col-lg-7">
                    <div style="position: relative; margin-bottom: -60px;" class="ohidden" data-height-lg="426" data-height-md="567" data-height-sm="470" data-height-xs="287" data-height-xxs="183">
                        <img src="images/stories/travels/mnongkhai/mm2.jpg" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="100" alt="Chrome">
                        <!--<img src="images/stories/travels/mnongkhai/lam21.jpg" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="400" alt="iPad">-->
                    </div>
                </div>
            </div>
        </div>
        <br/><br/><br/>

        <div class="container clearfix">
            <div class="col_full clearfix">
                <h3><?= Yii::t('app', 'Gallery') ?></h3>
                <div style="margin-right: -1px; position: relative; height: 855.75px;" class="masonry-thumbs col-3" data-big="2" data-lightbox="gallery">
                    <a style="width: 380px; position: absolute; left: 0px; top: 0px;" href="images/frontgallery/street_marget.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/street_marget.jpg" alt="Gallery Thumb 1"></a>
                    <a style="width: 760px; position: absolute; left: 380px; top: 0px;" href="images/frontgallery/watpochai.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/watpochai.jpg" alt="Gallery Thumb 2"></a>
                    <a style="width: 380px; position: absolute; left: 0px; top: 285px;" href="images/frontgallery/street_marget.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/street_marget.jpg" alt="Gallery Thumb 3"></a>
                    <a style="width: 380px; position: absolute; left: 380px; top: 570px;" href="images/frontgallery/street_marget.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/street_marget.jpg" alt="Gallery Thumb 4"></a>
                    <a style="width: 380px; position: absolute; left: 760px; top: 570px;" href="images/frontgallery/street_marget.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/street_marget.jpg" alt="Gallery Thumb 5"></a>
                    <a style="width: 380px; position: absolute; left: 0px; top: 570px;" href="images/frontgallery/river01.jpg" data-lightbox="gallery-item"><img style="opacity: 1;" class="image_fade" src="images/frontgallery/river01.jpg" alt="Gallery Thumb 6"></a>
                </div>
            </div>
            <div class="divider"><i class="icon-circle center"></i></div>
        </div>

        <div class="container clearfix">

            <div class="row topmargin-lg bottommargin-sm">

                <div class="heading-block center">
                    <h2>Even more Feature Rich</h2>
                    <span class="divcenter">Philanthropy convener livelihoods, initiative end hunger gender rights local. John Lennon storytelling; advocate, altruism impact catalyst.</span>
                </div>

                <div class="col-md-4 col-sm-6 bottommargin">

                    <div class="feature-box fbox-right topmargin" data-animate="fadeIn">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-line-heart"></i></a>
                        </div>
                        <h3>Boxed &amp; Wide Layouts</h3>
                        <p>Stretch your Website to the Full Width or make it boxed to surprise your visitors.</p>
                    </div>

                    <div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="200">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-line-paper"></i></a>
                        </div>
                        <h3>Extensive Documentation</h3>
                        <p>We have covered each &amp; everything in our Docs including Videos &amp; Screenshots.</p>
                    </div>

                    <div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="400">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-line-layers"></i></a>
                        </div>
                        <h3>Parallax Support</h3>
                        <p>Display your Content attractively using Parallax Sections with HTML5 Videos.</p>
                    </div>

                </div>

                <div class="col-md-4 hidden-sm bottommargin center">
                    <img src="themes/convas/images/services/iphone7.png" alt="iphone 2">
                </div>

                <div class="col-md-4 col-sm-6 bottommargin">

                    <div class="feature-box topmargin" data-animate="fadeIn">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-line-power"></i></a>
                        </div>
                        <h3>HTML5 Video</h3>
                        <p>Canvas provides support for Native HTML5 Videos that can be added to a Background.</p>
                    </div>

                    <div class="feature-box topmargin" data-animate="fadeIn" data-delay="200">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-line-check"></i></a>
                        </div>
                        <h3>Endless Possibilities</h3>
                        <p>Complete control on each &amp; every element that provides endless customization.</p>
                    </div>

                    <div class="feature-box topmargin" data-animate="fadeIn" data-delay="400">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-bulb"></i></a>
                        </div>
                        <h3>Light &amp; Dark Color Schemes</h3>
                        <p>Change your Website's Primary Scheme instantly by simply adding the dark class.</p>
                    </div>

                </div>

            </div>

        </div>

        <div class="row clearfix common-height">

            <div class="col-md-6 center col-padding" style="background: url('themes/convas/images/services/main-bg.jpg') center center no-repeat; background-size: cover;">
                <div>&nbsp;</div>
            </div>

            <div class="col-md-6 center col-padding" style="background-color: #F5F5F5;">
                <div>
                    <div class="heading-block nobottomborder">
                        <span class="before-heading color">Easily Understandable &amp; Customizable.</span>
                        <h3>Walkthrough Videos &amp; Demos</h3>
                    </div>

                    <div class="center bottommargin">
                        <a href="http://vimeo.com/101373765" data-lightbox="iframe" style="position: relative;">
                            <img src="themes/convas/images/services/video.jpg" alt="Video">
                            <span class="i-overlay nobg"><img src="themes/convas/images/icons/video-play.png" alt="Play"></span>
                        </a>
                    </div>
                    <p class="lead nobottommargin">Democracy inspire breakthroughs, Rosa Parks; inspiration raise awareness natural resources. Governance impact; transformative donation philanthropy, respect reproductive.</p>
                </div>
            </div>

        </div>

    </div>

</section><!-- #content end -->
