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
                            }
                            $menuItems = app\models\Menus::listMenus(0, 0, $type);
                            echo NavX::widget([
                                'encodeLabels' => false,
                                'items' => $menuItems,
                            ]);
                            ?>

                        </nav><!-- #primary-menu end -->
                    </div>
                </div>
            </header><!-- #header end -->
            <?= $content ?>
        </div><!-- #wrapper end -->

        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>
        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
