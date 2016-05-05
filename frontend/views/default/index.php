<?php
/*
 * $this yii\web\View
 * $model developerav\forum\common\models\Posts
 */

use yii\helpers\Html;

$this->title = 'Блог'
?>

<?php
foreach ($models as $model):
    ?>
    <h2>
        <?= Html::a($model['title'], ['view', 'id' => $model['id']]) ?>
    </h2>
    <p class="lead">
        Автор: <?= $model['user']['username'] ?>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Опубликован <?= Yii::$app->formatter->asDateTime($model['created_at']); ?></p>
    <?php
    if (!empty($model['img'])):
        ?>
        <hr>
        <div class="text-center">
            <img style="display: inline-block;" class="img-responsive" src="<?= $model['img'] ?>" alt="">
        </div>
        <hr>
    <?php endif; ?>
    <p><?= $model['text'] ?></p>
    <?= Html::a('Read More <span class="glyphicon glyphicon-chevron-right"></span>', ['view', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>

    <hr>
    <?php
endforeach;
?>