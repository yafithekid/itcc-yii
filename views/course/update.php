<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\Course */

$this->title = 'Ubah Kuliah: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_jurusan' => $list_jurusan,
    ]) ?>

</div>
