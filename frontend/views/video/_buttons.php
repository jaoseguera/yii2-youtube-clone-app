<?php

/** @var $model \common\models\Video */

use Yii;
use yii\helpers\Url;

?>

<a href="<?php echo Url::to(['/video/like', 'id' => $model->video_id]) ?>" data-method="post" data-pjax="1" class="btn btn-sm <?php echo $model->isLikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'?>">
    <i class="fa-solid fa-thumbs-up"></i> <?php echo $model->getLikes()->count(); ?>
</a>

<a href="<?php echo Url::to(['/video/dislike', 'id' => $model->video_id]) ?>" data-method="post" data-pjax="1" class="btn btn-sm <?php echo $model->isDisLikedBy(Yii::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary'?>">
    <i class="fa-solid fa-thumbs-down"></i> <?php echo $model->getDislikes()->count(); ?>
</a>