<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Kuliah';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isTeacher()): ?>
    <p>
        <?= Html::a('Tambah Kuliah', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php foreach($list_fakultas as $fakultas): ?>
        <?="<h4>$fakultas->name</h4>"; ?>
        <?php foreach($fakultas->departments as $jurusan): ?>
            <?= "<b>".Html::a($jurusan->name,['/department/view','id'=>$jurusan->id])."</b><br>"; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

</div>
