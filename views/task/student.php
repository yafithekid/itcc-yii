<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\db\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Tugas Anda';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <table class='table table-condensed'>
    <tr>
      <th>Tugas</th>
      <th>Deadline</th>
    </tr>
    <?=
    ListView::widget([
       'dataProvider' => $dataProvider,
       'itemOptions' => ['class' => 'item'],
       'itemView' => function ($model, $key, $index, $widget) {
            return "<tr>".
              "<td>".Html::a($model->title,['/task/view','id'=>$model->id])."</td>".
              "<td>".Html::encode($model->deadline)."</td>".
             // "<td>".Html::a("<span class='glyphicon glyphicon-search'></span>")."</td>".
              "</tr>";
       },
       'summary'=>'',
       'layout'=>'{items}',
    ]);
    ?>
    </table>
</div>
