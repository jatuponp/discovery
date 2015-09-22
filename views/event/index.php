<?php

use talma\widgets\FullCalendar;
use app\components\Ncontent;
?>
<section id="content">

    <div class="content-wrap">

        <div class="parallax header-stick bottommargin-lg light" style="padding: 60px 0; background-image: url('<?= Yii::getAlias('@web'); ?>/images/calendar.jpg'); height: auto;" data-stellar-background-ratio="0.5">

            <div class="container clearfix" >

                <div class="events-calendar">
                    <div class="events-calendar-header clearfix">
                        <h2 style="color: #ffffff;"><?= Yii::t('app', 'Events Overview') ?></h2>
                        <?=
                        FullCalendar::widget([
                            'googleCalendar' => true, // If the plugin displays a Google Calendar. Default false
                            'loading' => 'Loading...', // Text for loading alert. Default 'Loading...'
                            'config' => [
                                // put your options and callbacks here
                                // see http://arshaw.com/fullcalendar/docs/
                                'lang' => 'th-th', // optional, if empty get app language
                                'header' => [
                                    'left' => 'prev,next today',
                                    'center' => 'title',
                                    'right' => 'month,agendaWeek,agendaDay'
                                ],
                                'editable' => false,
                                //'events' => $model->searchCalendarAll(),
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container clearfix">
            <div class="clear"></div>
            <div class="divider divider-center"><i class="icon-circle-blank"></i></div>
            <h3><?= Yii::t('app', 'Upcoming Events') ?></h3>
            <div id="posts" class="events small-thumbs">

                <?php
                foreach ($model->eventNews() as $r):
                    $cont = new Ncontent($r->fulltexts);
                    $month = date("M", strtotime($r->startdate));
                    $day = date("j", strtotime($r->startdate));
                    ?>
                    <div class="entry clearfix">
                        <div class="entry-image">
                            <a href="<?= \yii\helpers\Url::to(['site/view', 'id' => $r->id]) ?>">
                                <img src="<?= $cont->getImg() ?>" alt="Nong Khai Discovery">
                                <div class="entry-date"><?= $day ?><span><?= $month ?></span></div>
                            </a>
                        </div>
                        <div class="entry-c">
                            <div class="entry-title">
                                <h2><a href="#"><?= $r->title ?></a></h2>
                            </div>
                            <div class="entry-content">
                                <p><?= $cont->getLimitText(500) ?>...</p>
                                <a href="<?= \yii\helpers\Url::to(['site/view', 'id' => $r->id]) ?>" class="btn btn-danger"><?= Yii::t('app', 'Read More') ?></a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>