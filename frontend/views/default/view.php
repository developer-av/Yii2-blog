<?php
/*
 * $this yii\web\View
 * $model developerav\blog\common\models\Posts
 */

use yii\helpers\Html;
$this->title = $model['title'];
$this->params['breadcrumbs'][] = ['label' => yii::t('blog', 'Блог'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['user'][\Yii::$app->controller->module->userField], 'url' => ['index', 'username' => $model['user'][\Yii::$app->controller->module->userField]]];
$this->params['breadcrumbs'][] = $this->title;
?>


<h2>
    <?= $model['title'] ?>
</h2>
<p class="lead">
    <?= yii::t('blog', 'Автор') ?>: <?= Html::a($model['user'][\Yii::$app->controller->module->userField], ['index', 'username' => $model['user'][\Yii::$app->controller->module->userField]]) ?>
</p>
<p><span class="glyphicon glyphicon-time"></span> <?= yii::t('blog', 'Опубликован') ?> <?= Yii::$app->formatter->asDateTime($model['created_at']); ?></p>
<?php
if (!empty($model['img'])):
    ?>
    <hr>
    <div class="text-center">
        <img style="display: inline-block;" class="img-responsive" src="/upload/blog/<?= $model['img'] ?>" alt="">
    </div>
    <hr>
<?php endif; ?>
<p><?= $model['text'] ?></p>
