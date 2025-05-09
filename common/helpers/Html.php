<?php

namespace common\helpers;
use \yii\helpers\Url;

class Html
{
    public static function channelLink($user, $schema = false)
    {
        return \yii\helpers\Html::a($user->username, 
        //Hhtml::a creates a relative path, we need to create a schema. When schema is true it will be generated.
        Url::to(['/channel/view', 'username' => $user->username], $schema ), ['class' => 'text-dark']);
    }
}