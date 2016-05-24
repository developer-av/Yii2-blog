<?php
/*
 * $this yii\web\View
 * $model developerav\blog\common\models\Posts
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = yii::t('blog', 'Блог');
if (yii::$app->request->get('username')) {
    $this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
    $this->title .= ' ' . yii::$app->request->get('username');
    $this->params['breadcrumbs'][] = yii::$app->request->get('username');
} else {
    $this->params['breadcrumbs'][] = $this->title;
}
?>

<?php
foreach ($models as $model):
    ?>
    <h2>
        <?= Html::a($model['title'], ['view', 'id' => $model['id']]) ?>
    </h2>
    <p class="lead">
        <?= yii::t('blog', 'Автор') ?>: <?= Html::a($model['user'][\Yii::$app->controller->module->userField], ['', 'username' => $model['user'][\Yii::$app->controller->module->userField]]) ?>
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
    <?= Html::a(yii::t('blog', 'Прочитать полностью').' <span class="glyphicon glyphicon-chevron-right"></span>', ['view', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>

    <hr>
    <?php
endforeach;
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>