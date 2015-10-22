<?php

use yii\helpers\Html;
use app\components\Ncontent;
use yii\data\Pagination;
//use kartik\social\GoogleAnalytics;

//echo GoogleAnalytics::widget(['objectName' => 'ga']);

$this->title = Yii::t('app', 'all News');
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
         <div class="row" style="padding-right: 15px;">
                <?php
                foreach ($model as $r) {
                    $cont = new Ncontent($r->fulltexts);
                    ?>
                    <div class="row">
                        <div class="col-sm-8">                            
                            <div class="caption" style="padding: 10px; margin-bottom: 10px;">
                                <div style="font-size: 16px;"><a href="<?= \yii\helpers\Url::to(['/site/view', 'id' => $r->id]) ?>"><?= $r->title ?></a></div>
                                <div style="color: green;"><?= Yii::$app->urlManager->createAbsoluteUrl(['/site/view', 'id' => $r->id]) ?></div>
                                <div>
                                    <div class="pull-left" style="margin-right: 10px;"><img src="<?= $cont->getImg() ?>" width="150px" /></div><?= $cont->getLimitText() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div> 
                    <br/>
                <?php } ?>            
            </div>   
        </div>
    </div>

</div>



