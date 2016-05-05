<?php

namespace developerav\forum\backend;

use Yii;

class Module extends \yii\base\Module {

    public function init() {
        if (!isset(Yii::$app->i18n->translations['forum'])) {
            Yii::$app->i18n->translations['forum'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru-RU',
                'basePath' => '@vendor/developer-av/yii2-forum/backend/messages'
            ];
        }
        parent::init();
    }

}
