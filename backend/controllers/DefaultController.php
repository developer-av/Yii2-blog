<?php

namespace developerav\forum\backend\controllers;

class DefaultController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

}
