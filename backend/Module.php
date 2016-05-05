<?php

namespace developerav\blog\backend;

use Yii;

class Module extends \yii\base\Module {

    public function init() {
        if (!isset(Yii::$app->i18n->translations['blog'])) {
            Yii::$app->i18n->translations['blog'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru-RU',
                'basePath' => '@vendor/developer-av/yii2-blog/backend/messages'
            ];
        }
        parent::init();
    }

}
