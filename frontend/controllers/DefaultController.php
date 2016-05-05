<?php

namespace developerav\forum\frontend\controllers;

class DefaultController extends \yii\web\Controller {

    public function actionIndex($id = null) {
        $module = \Yii::$app->controller->module;
        
        return $this->render('index');
    }

}
