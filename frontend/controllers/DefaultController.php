<?php

namespace developerav\forum\frontend\controllers;

class DefaultController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

}
