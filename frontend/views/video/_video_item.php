<?php

/** @var $model  \common\models\Video 
 * 
 */

 use yii\helpers\Url;
?>

<div class="card m-3" style="width: 14rem;">
    <a href="<?php echo Url::to(['/video/view', 'id' => $model->video_id]) ?>">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" style="width: 250px"
                poster="<?php echo $model->getThumbnailLink() ?>"
                src="<?php echo $model->getVideoLink() ?>"></video>
        </div>
    </a>
    <div class="card-bod p-2">
        <h5 class="card-title m-0"><?php echo $model->title ?></h5>
        <p class="text-muted card-text m-0">
            <?php
            //Access to the User.username through the createdBy (it's a link between Video an User)
            echo $model->createdBy->username ?>
        </p>
        <p class="text-muted card-text m-0">
            140 views . <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
        </p>
    </div>
</div>