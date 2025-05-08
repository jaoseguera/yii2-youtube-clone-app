<?php

namespace common\helpers;

class Html
{
    public static function channelLink($user)
    {
        return \yii\helpers\Html::a($user->username, [
            //Defines de controller and sends the parameter Username to it.
            '/channel/view',
            'username' => $user->username,
        ], ['class' => 'text-dark']);
    }
}
