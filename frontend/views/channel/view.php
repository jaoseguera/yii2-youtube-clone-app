<?php
/**
 * @var $channel \common\models\User
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
 use \yii\widgets\Pjax;
?>

<div class="jumbotron">
    <h1 class="display-4"><?php echo $channel->username;  ?></h1>
    <hr class="my-4">
    <p class="lead">
        <?php Pjax::begin() ?>
        <?php echo $this->render('_subscribe', [
            'channel' => $channel,
        ]); ?>
        <?php Pjax::end() ?>
    </p>
</div>

<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@frontend/views/video/_video_item',
    //Allows the video cards appear next to each other and avoids to show summary.
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ],
]);
?>