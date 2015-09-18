<?php

use yii\helpers\Html;
use app\web\themes\convas\assets\ThemeAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\nav\NavX;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
ThemeAsset::register($this);
$this->registerMetaTag(['Keywords' => 'เที่ยวหนองคาย,หนองคาย, บั้งไฟ, แม่น้ำโขง, น้ำโขง, พญานาค, ร้านอาหาร หนองคาย,ที่พักหนองคาย,โรงแรม หนองคาย,รีสอร์ท หนองคาย,เที่ยว หนองคาย,ที่เที่ยวหนองคาย, ไปหนองคาย, แผนที่หนองคาย, ซื้อของฝาก, ขายของฝาก หนองคาย,หนองคาย,Nongkhai, Travel, NongkhaiHotel, Hotel, Naga FireBall, Resort, Discovery, Thailand, Map, Mekong River, Tour']);
$this->registerMetaTag(['description' => 'หนองคาย จังหวัดหนองคาย น้ำโขง สถานที่ท่องเที่ยว ข้อมูลการท่องเที่ยว ค้นหาแผนที่ ที่พัก โรงแรม รีสอร์ท ร้านอาหาร ร้านกาแฟ ร้านของฝาก การท่องเที่ยว nongkhai hotel discovery thailand mekong']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="stretched">
        <?php $this->beginBody() ?>
        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">

            <!-- Header -->            
            <header id="header" class="<?= ((Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? 'transparent-header' : '') ?> full-header" data-sticky-class="not-dark">
                <div id="header-wrap">
                    <div class="container clearfix">
                        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                        <!-- Logo
                        ============================================= -->
                        <div id="logo">
                            <a href="<?= Url::to(['/']) ?>" class="standard-logo" data-dark-logo="<?= $this->theme->baseUrl; ?>/images/logo-dark.png"><img src="<?= $this->theme->baseUrl; ?>/images/logo.png" alt="Nong Khai Discovery"></a>
                            <a href="<?= Url::to(['/']) ?>" class="retina-logo" data-dark-logo="<?= $this->theme->baseUrl; ?>/images/logo-dark@2x.png"><img src="<?= $this->theme->baseUrl; ?>/images/logo@2x.png" alt="Nong Khai Discovery"></a>
                        </div><!-- #logo end -->

                        <!-- Primary Navigation
                        ============================================= -->
                        <nav id="primary-menu">

                            <?php
                            $_l = Yii::$app->language;
                            if ($_l == 'th_TH') {
                                $type = 1;
                            } else if ($_l == 'en_EN') {
                                $type = 2;
                            } else if ($_l == 'lo_LO') {
                                $type = 3;
                            } else if ($_l == 'vi_VI') {
                                $type = 4;
                            } else {
                                $type = 1;
                            }
                            $menuItems = app\models\Menus::listMenus(0, 0, $type);
                            echo NavX::widget([
                                'encodeLabels' => false,
                                'items' => $menuItems,
                            ]);
                            ?>

                            <!-- Top Cart
                                                ============================================= -->
                            <div id="top-cart">
                                <a href="#" id="top-cart-trigger" title="Choose language"><img src="<?= Yii::getAlias('@web') . '/images/lang-th.png' ?>" /></a>
                                <div class="top-cart-content">
                                    <div class="top-cart-title">
                                        <h4>Choose Language</h4>
                                    </div>
                                    <div class="top-cart-items">
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-image">
                                                <a href="<?= Url::to(['/', '_lang' => 'th_TH']) ?>"><img src="<?= Yii::getAlias('@web') . '/images/lang-th.png' ?>" /></a>
                                            </div>
                                            <div class="top-cart-item-desc">
                                                <a href="<?= Url::to(['/', '_lang' => 'th_TH']) ?>">ภาษาไทย</a>
                                            </div>                                                                            
                                        </div>
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-image">
                                                <a href="<?= Url::to(['/', '_lang' => 'en_EN']) ?>"><img src="<?= Yii::getAlias('@web') . '/images/lang-en.png' ?>" /></a>
                                            </div>
                                            <div class="top-cart-item-desc">
                                                <a href="<?= Url::to(['/', '_lang' => 'en_EN']) ?>">English</a>
                                            </div>                                                                            
                                        </div>
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-image">
                                                <a href="<?= Url::to(['/', '_lang' => 'lo_LO']) ?>"><img src="<?= Yii::getAlias('@web') . '/images/lang-lao.png' ?>" /></a>
                                            </div>
                                            <div class="top-cart-item-desc">
                                                <a href="<?= Url::to(['/', '_lang' => 'lo_LO']) ?>">Laos</a>
                                            </div>                                                                            
                                        </div>
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-image">
                                                <a href="<?= Url::to(['/', '_lang' => 'vi_VI']) ?>"><img src="<?= Yii::getAlias('@web') . '/images/lang-vi.png' ?>" /></a>
                                            </div>
                                            <div class="top-cart-item-desc">
                                                <a href="<?= Url::to(['/', '_lang' => 'vi_VI']) ?>">Vietnam</a>
                                            </div>                                                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- #top-cart end -->

                            <!-- Top Search
                            ============================================= -->
                            <div id="top-search">
                                <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                                <form action="<?= Url::to(['site/search']) ?>" method="get">
                                    <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
                                </form>
                            </div><!-- #top-search end -->

                        </nav><!-- #primary-menu end -->
                    </div>
                </div>
            </header><!-- #header end -->
            <?= $content ?>
            <!-- Footer
                ============================================= -->
            <footer id="footer" class="dark">

                <div class="container">

                    <!-- Footer Widgets
                    ============================================= -->
                    <div class="footer-widgets-wrap clearfix">
                        <div class="col_one_fifth">
                            <div class="widget clearfix">
                                <img src="<?= Yii::getAlias('@web') ?>/images/01.png" alt="">
                                <br/>
                                <div>
                                    <address>
                                        <strong>ที่ตั้ง:</strong><br>
                                        ศูนย์ราชการ ถนนมิตรภาพหนองคาย - อุดรธานี 
                                        ตำบลหนองกอมเกาะ อำเภอเมือง 
                                        จังหวัดหนองคาย 43000
                                    </address>
                                    <abbr title="Phone Number"><strong>Phone:</strong></abbr> 042-412678 ต่อ 46148<br>
                                    <abbr title="Email Address"><strong>Email:</strong></abbr> wilaiwan_tan@moi.go.th
                                </div>
                            </div>
                        </div>

                        <div class="col_one_fifth">

                            <?php
                            $ques = \app\models\Menus::find()->where(['parent_id' => 0, 'published' => 1, 'langs' => \app\components\langs::getlang()])->orderBy('ordering');
                            $rows = $ques->all();
                            $r = $rows[0];
                            ?>
                            <div class="widget widget_links clearfix">

                                <h4><?= $r->names ?></h4>
                                <ul>
                                    <?php
                                    $que = \app\models\Menus::find()->where(['parent_id' => $r->id, 'published' => 1])->orderBy('ordering');
                                    $row = $que->all();
                                    foreach ($row as $s):
                                        ?>
                                        <li><a href="<?= $s->urls ?>"><?= $s->names ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>

                        <div class="col_one_fifth">

                            <?php
                            $r1 = $rows[1];
                            ?>
                            <div class="widget widget_links clearfix">

                                <h4><?= $r1->names ?></h4>
                                <ul>
                                    <?php
                                    $que = \app\models\Menus::find()->where(['parent_id' => $r1->id, 'published' => 1])->orderBy('ordering');
                                    $row = $que->all();
                                    foreach ($row as $s):
                                        ?>
                                        <li><a href="<?= $s->urls ?>"><?= $s->names ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>
                        <div class="col_one_fifth">

                            <?php
                            $r2 = $rows[2];
                            ?>
                            <div class="widget widget_links clearfix">

                                <h4><?= $r2->names ?></h4>
                                <ul>
                                    <?php
                                    $que = \app\models\Menus::find()->where(['parent_id' => $r2->id, 'published' => 1])->orderBy('ordering');
                                    $row = $que->all();
                                    foreach ($row as $s):
                                        ?>
                                        <li><a href="<?= $s->urls ?>"><?= $s->names ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>

                        <div class="col_one_fifth col_last">

                            <?php
                            $r3 = $rows[3];
                            ?>
                            <div class="widget widget_links clearfix">

                                <h4><?= $r3->names ?></h4>
                                <ul>
                                    <?php
                                    $que = \app\models\Menus::find()->where(['parent_id' => $r3->id, 'published' => 1])->orderBy('ordering');
                                    $row = $que->all();
                                    foreach ($row as $s):
                                        ?>
                                        <li><a href="<?= $s->urls ?>"><?= $s->names ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                        </div>

                        <!--                        <div class="col_one_third col_last">
                        
                                                    <div class="widget clearfix" style="margin-bottom: -20px;">
                        
                                                        <div class="row">
                        
                                                            <div class="col-md-6 bottommargin-sm">
                                                                <div class="counter counter-small"><span data-from="50" data-to="<?= \app\components\counter::getTotalCounter() ?>" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
                                                                <h5 class="nobottommargin">จำนวนผู้เยื่ยมชม</h5>
                                                            </div>
                        
                                                        </div>
                        
                                                    </div>
                        
                                                    <div class="widget clearfix" style="margin-bottom: -20px;">
                        
                                                        <div class="row">
                        
                                                            <div class="col-md-6 clearfix bottommargin-sm">
                                                                <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                                                                    <i class="icon-facebook"></i>
                                                                    <i class="icon-facebook"></i>
                                                                </a>
                                                                <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                                                            </div>
                                                            <div class="col-md-6 clearfix">
                                                                <a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
                                                                    <i class="icon-rss"></i>
                                                                    <i class="icon-rss"></i>
                                                                </a>
                                                                <a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
                                                            </div>
                        
                                                        </div>
                        
                                                    </div>
                        
                                                </div>-->

                    </div><!-- .footer-widgets-wrap end -->

                </div>
                
                <!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container clearfix">

					<div class="col_half">
						Copyrights &copy; 2015 NongkhaiDiscovery. All rights reserved.<br>
						<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
					</div>

					<div class="col_half col_last tright">
						<div class="fright clearfix">
                                                    &nbsp;จำนวนผู้เยี่ยมชม: <?= number_format(\app\components\counter::getTotalCounter(), 0, '.', ',') ?>
						</div>

						<div class="clear"></div>

						<i class="icon-envelope2"></i> wilaiwan_tan(at)moi.go.th <span class="middot">&middot;</span> <i class="icon-headphones"></i> (+66) 042-412678 ต่อ 46148
					</div>

				</div>

			</div><!-- #copyrights end -->

            </footer><!-- #footer end -->
        </div><!-- #wrapper end -->

        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>
        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
