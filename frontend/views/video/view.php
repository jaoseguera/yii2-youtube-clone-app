<?php

/**
 * @var $model \common\models\Video
 */

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
    <div class="col-sm-4">

    </div>
</div>