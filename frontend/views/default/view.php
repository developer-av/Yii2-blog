<?php
/*
 * $this yii\web\View
 * $model developerav\blog\common\models\Posts
 */


$this->title = $model['title'];
?>


<h2>
    <?= $model['title'] ?>
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
