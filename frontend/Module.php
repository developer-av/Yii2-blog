<?php

namespace developerav\blog\frontend;

class Module extends \yii\base\Module {

    public $individualPages = false;

    public $userModel = '\common\models\User';
    public $userField = 'username';

    public function init() {
        parent::init();
    }

}
