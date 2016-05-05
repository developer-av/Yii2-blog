<?php

namespace developerav\forum\frontend\controllers;

use developerav\forum\common\models\Posts;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

class DefaultController extends \yii\web\Controller {

    public function actionIndex($id = null) {

        $module = \Yii::$app->controller->module;

        if ($module->individualPages == true) {
            if ($id === null) {
                throw new NotFoundHttpException('Такой страницы не существует');
            }
            $query = Posts::find()->where(['user_id' => $id]);
        } else {
            $query = Posts::find();
        }

        // делаем копию выборки
        $countQuery = clone $query;
        // подключаем класс Pagination, выводим по 10 пунктов на страницу
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        // приводим параметры в ссылке к ЧПУ
        $pages->pageSizeParam = false;
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy('id DESC')
                ->asArray()
                ->with('user')
                ->all();

        $models = Posts::Preview($models);

        if (empty($models)) {
            throw new NotFoundHttpException('Такой страницы не существует');
        }

        return $this->render('index', ['models' => $models]);
    }

    public function actionView($id) {
        $model = Posts::find()->where(['id' => $id])->asArray()->with('user')->one();
        if (empty($model)) {
            throw new NotFoundHttpException('Такой страницы не существует');
        }
        return $this->render('view', ['model' => $model]);
    }

}
