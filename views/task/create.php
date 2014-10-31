<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Task */

$this->title = 'Tambah tugas';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'courses' => $courses,
    ]) ?>

</div>
