<?php

namespace developerav\blog\common\models;

use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;

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

    public $file;
    public $oldRecord;

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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
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

    public function afterFind() {
        $this->oldRecord = clone $this;
        return parent::afterFind();
    }

    public function beforeDelete() {
        $this->deletePhoto();
        return parent::beforeDelete();
    }

    public function beforeSave($insert) {
        if ($this->file) {
            self::uploadFile($this);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [
                ['file'],
                'image',
                'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
                'maxSize' => 1024 * 1024 * 10, //10Мб
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        $user = (isset(\Yii::$app->controller->module->userModel::attributeLabels()[\Yii::$app->controller->module->userField])? \Yii::$app->controller->module->userModel::attributeLabels()[\Yii::$app->controller->module->userField] : self::generateAttributeForUserField(\Yii::$app->controller->module->userField));
        return [
            'id' => 'ID',
            'title' => 'Title',
            'img' => 'Img',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user' => $user,
        ];
    }

    public function getUser() {
        return $this->hasOne(\Yii::$app->controller->module->userModel::className(), ['id' => 'user_id'])->select([\Yii::$app->controller->module->userField, 'id']);
    }

    public static function Preview($models) {
        foreach ($models as $key => $model) {
            $models[$key]['text'] = StringHelper::truncate(strip_tags($model['text']), 400);
        }
        return $models;
    }

    public static function generateAttributeForUserField($name) {
        return Inflector::camel2words($name, true);
    }

    public function deletePhoto() {
        if (!empty($this->img)) {
            unlink(\Yii::getAlias('@webroot') . '/upload/blog/' . $this->img);
        }
    }

    private static function uploadFile($obg) {
        if (!empty($obg->oldRecord->img)) {
            unlink(\Yii::getAlias('@webroot') . '/upload/blog/' . $obg->oldRecord->img);
        }
        $obg->img = \Yii::$app->security->generateRandomString() . '.' . $obg->file->extension;
        $obg->file->saveAs(\Yii::getAlias('@webroot') . '/upload/blog/' . $obg->img);
    }

}
