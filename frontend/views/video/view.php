<?php

/**
 * @var $model \common\models\Video
 * @var $similarVideos \common\models\Video[]
 */

use \yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" style="width: 500px"
                poster="<?php echo $model->getThumbnailLink() ?>"
                src="<?php echo $model->getVideoLink() ?>" controls></video>
        </div>
    </div>
    <h6 class="mt-2"><?php echo $model->title ?></h6>
    <div class="d-flex justify-content-between align-items-center">
        <?php echo $model->getViews()->count() ?> views - <?php echo Yii::$app->formatter->asDate($model->created_at) ?></div>
    <div>
        <!-- Pjax is an Ajax tool. With it the <a> won't redirect the user to /video/like instead it will remain in the same page. Note: All the Pjax area will be replaced by whatever the controller returns. For example, the two like and dislike buttons could be replaced by a "sucess" string return by the likeAction()-->
        <?php \yii\widgets\Pjax::begin() ?>
        <?php echo $this->render('_buttons', [
            'model' => $model,
        ]); ?>
        <?php \yii\widgets\Pjax::end() ?>
    </div>
    <div>
        <p>
            <?php echo \common\helpers\Html::channelLink($model->createdBy); ?>
        </p>
        <p><?php echo Html::encode($model->description) ?></p>
    </div>
    <div class="col-sm-4">
        <?php foreach ($similarVideos as $similarVideo): ?>
            <a href="<?php echo Url::to(['video/view', 'id' => $similarVideo->video_id])?>">
                <div class="media mb-3">
                    <div class="embed-responsive embed-responsive-16by9 mr-2" style="width:100px">
                        <video class="embed-responsive-item" style="width: 500px"
                            poster="<?php echo $similarVideo->getThumbnailLink() ?>"
                            src="<?php echo $similarVideo->getVideoLink() ?>"></video>
                    </div>
                    <div class="media-body">
                        <h6 class="mt-0"><?php echo $similarVideo->title ?></h6>
                        <div class="class-muted">
                            <p class="m-0">
                                <?php echo \common\helpers\Html::channelLink($similarVideo->createdBy); ?>
                            </p>
                            <small class="m-0">
                                <?php echo $similarVideo->getViews()->count(); ?> views *
                                <?php echo Yii::$app->formatter->asRelativeTime($similarVideo->created_at); ?>
                            </small>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>