<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Faculty */

$this->title = 'Tambah Fakultas';
$this->params['breadcrumbs'][] = ['label' => 'Faculties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faculty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
