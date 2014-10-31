<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Tugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Buat Tugas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
       'dataProvider' => $dataProvider,
       'columns' => [
       	'course.name',
       	'title',
       	'deadline',
       	['class' => 'yii\grid\ActionColumn'],
       ]
    ]);
    ?>

</div>
