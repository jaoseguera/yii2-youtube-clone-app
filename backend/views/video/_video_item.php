<?php 
/**
 * 
 */
/** @var $model \common\models\Video */
use \yii\helpers\StringHelper;
use \yii\helpers\Url;
?>

<div class="media">
    <a href="<?php echo Url::to(['/video/update', 'video_id' => $model->video_id]) ?>">
    <div class="embed-responsive embed-responsive-16by9 mr-2 ratio ratio-16x9" style="width: 120px">
        <video class="embed-responsive-item" poster="<?php echo $model->getThumbnailLink() ?>"
            src="<?php echo $model->getVideoLink() ?>"></video>
    </div>
    </a>
    <div class="media-body">
        <h6 class="mt-0"><?php $model->title ?></h6>
        <?php echo StringHelper::truncate($model->description, 10) ?>
    </div>
</div>