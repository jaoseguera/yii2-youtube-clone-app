<?php
/**
 */
/** @var $this \yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
?>

<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    //Allows the video cards appear next to each other and avoids to show summary.
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ],
]);
?>