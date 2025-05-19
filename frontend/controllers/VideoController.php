<?php

namespace frontend\controllers;

use Yii;
use common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                //Only applies to the like and dislike buttons.
                'only' => ['like', 'dislike', 'history'],
                'rules' => [
                    [
                        //Allows only authentified users.
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verb' => [
                'class' => VerbFilter::class,
                //For Like and Unlike only Post methods are allowed.
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            //With command optimizes the query. Instead of doing a lot of SELECTs, will do only one with the command IN.
            //Select * from user where id IN ()
            'query' => Video::find()->with('createdBy')->published(),
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
        $this->layout = 'auth';
        $video = $this->findVideo($id);

        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();

        $similarVideos = VIdeo::find()->published()->andWhere(['NOT', ['video_id' => $id]])->byKeyword($video->title)->limit(10)->all();

        return $this->render('view', [
            'model' => $video,
            'similarVideos' => $similarVideos,
        ]);
    }

    //Advanced search.
    public function actionSearch($keyword)
    {
        $query = Video::find()->published();

        if ($keyword) {
            $query->byKeyword($keyword);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionHistory()
    {
        /**
         * Implementation for:
         * 
         * select v.* from video v
         * inner join (select video_id, max(created_at) as max_date from video_view where user_id = 3 group by video_id) as vv
         * on vv.video_id = v.video_id
         * order by vv.max_date desc
         */
        $query = Video::find()->alias('v')->innerJoin('(select video_id, max(created_at) as max_date from video_view where user_id = :user_id group by video_id) vv', 'vv.video_id = v.video_id', [
            'user_id' => Yii::$app->user->id,
        ])->orderBy("vv.max_date DESC");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('history', [
            'dataProvider' => $dataProvider
        ]);
    }

    protected function findVideo($id)
    {
        $video = Video::findOne($id);

        if (!$video) {
            throw new NotFoundHttpException("Video does not exists.");
        }

        return $video;
    }

    public function actionLike($id)
    {
        $video = $this->findVideo($id);
        $userId = Yii::$app->user->id;

        $videoLike = VideoLike::find()->userIdVideoId($userId, $id)->one();

        if (!$videoLike) {
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
        } else if ($videoLike->type == VideoLike::TYPE_LIKE) {
            $videoLike->delete();
        } else {
            $videoLike->delete();
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_LIKE);
        }

        //renderAjax only renders the content, doesn't take in consideration the Layouts.
        return $this->renderAjax('_buttons', [
            'model' => $video,
        ]);
    }

    public function actionDislike($id)
    {
        $video = $this->findVideo($id);
        $userId = Yii::$app->user->id;

        $videoLike = VideoLike::find()->userIdVideoId($userId, $id)->one();

        if (!$videoLike) {
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
        } else if ($videoLike->type == VideoLike::TYPE_DISLIKE) {
            $videoLike->delete();
        } else {
            $videoLike->delete();
            $this->saveLikeDislike($id, $userId, VideoLike::TYPE_DISLIKE);
        }

        //renderAjax only renders the content, doesn't take in consideration the Layouts.
        return $this->renderAjax('_buttons', [
            'model' => $video,
        ]);
    }

    protected function saveLikeDislike($videoId, $userId, $type)
    {
        $videoLike = new VideoLike();

        $videoLike->video_id = $videoId;
        $videoLike->user_id = $userId;
        $videoLike->created_at = time();
        $videoLike->type = $type;
        $videoLike->save();
    }
}
