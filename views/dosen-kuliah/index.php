<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\db\UserCourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Course', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'course_id',
            'grade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
