<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\UserCourse */

$this->title = 'Update User Course: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'course_id' => $model->course_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
