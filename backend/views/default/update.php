<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model developerav\forum\common\models\Posts */

$this->title = Yii::t('forum', 'Update {modelClass}: ', [
    'modelClass' => 'Posts',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('forum', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('forum', 'Update');
?>
<div class="posts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
