<?php

namespace frontend\controllers;

use Yii;
use common\models\Video;
use common\models\VideoView;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published(),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $video = Video::findOne($id);
        if(!$video)
        {
            throw new NotFoundHttpException("Video does not exists.");
        }

        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();

        return $this->render('view', [
            'model' => $video,
        ]);
    }
}
