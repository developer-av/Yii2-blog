<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model developerav\blog\common\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Посты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('blog', 'Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('blog', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('blog', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.' . \Yii::$app->controller->module->userField,
            'title',
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => (!empty($model->img)? '<img style="display: inline-block;" class="img-responsive" src="/upload/blog/'.$model->img.'" alt="">' : 'Нет'),
            ],
            'text:html',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ])
    ?>

</div>
