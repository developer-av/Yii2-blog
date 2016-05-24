<?php

namespace developerav\blog\frontend;

use Yii;

class Module extends \yii\base\Module {

    public $individualPages = false;

    public $userModel = '\common\models\User';
    public $userField = 'username';

    public function init() {
        if (!isset(Yii::$app->i18n->translations['blog'])) {
            Yii::$app->i18n->translations['blog'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru-RU',
                'basePath' => '@vendor/developer-av/yii2-blog/frontend/messages'
            ];
        }
        parent::init();
    }

}
