<?php

namespace developerav\forum\common\models;

use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $img
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 */
class Posts extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'posts';
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ],
                'value' => function() {
            return date('U');
        },
            ],
            'username' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                ],
                'value' => function() {
            return \yii::$app->user->id;
        },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user.username' => 'User name',
            'title' => 'Title',
            'img' => 'Img',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser() {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id'])->select(['username', 'id']);
    }

    public static function Preview($models) {
        foreach ($models as $key => $model) {
            $models[$key]['text'] = StringHelper::truncate(strip_tags($model['text']), 400);
        }
        return $models;
    }

}
