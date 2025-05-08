<?php
/**
 * @var $this \yii\web\View
 * @var $channel \common\models\User
 */

use \yii\helpers\Url;
?>

<a class="btn <?php echo $channel->isSubscribed(Yii::$app->user->id) ? 'btn-secondary' : 'btn-danger'; ?>" href="<?php echo Url::to(['channel/subscribe', 'username' => $channel->username]); ?>" data-method='post' data-pjax='1' role="button">Suscribe <i class="fa-solid fa-bell"></i></a> <?php echo $channel->getSubscribers()->count(); ?>