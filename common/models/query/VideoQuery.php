<?php

namespace common\models\query;

use common\models\Video;

/**
 * This is the ActiveQuery class for [[\common\models\Video]].
 *
 * @see \common\models\Video
 */
class VideoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Video[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Video|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function creator($userId)
    {
        return $this->andWhere(['created_by' => $userId]);
    }

    public function published()
    {
        return $this->andWhere(['status' => Video::STATUS_PUBLISHED]);
    }

    public function byKeyword($keyword)
    {
        //Add the "console/migrations/m250512_201329_create_fulltext_index_on_video.php" migration so this can work.
        return $this->andWhere("MATCH(title, description, tags) AGAINST (:keyword)", ["keyword" => $keyword]);
    }
}
