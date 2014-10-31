<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">
    <div style='text-align:center'>
    <h1 ><?= Html::encode($this->title) ?></h1>
    <?= "Deadline: $model->deadline "; ?>
    </div>
    <br>
    <p>
    <?php if (Yii::$app->user->identity->isTeacher()): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>
    </p>
    <p>
    
    </p><br>
    <?php if (time() < strtotime($model->deadline)) :?>
        <p>
        <?= $this->render('_uploader',['model'=>$submission]);?>
        </p>
    <?php endif; ?>

    <p>
    <?=  Html::encode($model->description); ?>
    </p>
    <h4>Pengumpulan Anda</h4>
    <p>
    <table class='table table-striped table-condensed'>
    <tr>
        <th>No</th><th>Dikumpul</th><th>Download</th>   
    </tr>
    <?= ListView::widget([
        'dataProvider' => $submissionDataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return "<tr>".
            "<td>".($index + 1)."</td>".
            "<td>".$model->created_at."</td>".
            "<td>".Html::a("<span class='glyphicon glyphicon-download-alt'></span>",Yii::$app->request->baseUrl."/".$model->pathfile)."</td>".
            "</tr>";
        },
    ]) ?>
    </table>
    </p>
</div>
