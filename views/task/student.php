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
    <?=
    ListView::widget([
       'dataProvider' => $dataProvider,
       'itemOptions' => ['class' => 'item'],
       'itemView' => function ($model, $key, $index, $widget) {
            $style = '';
            switch ($model->result) {
                case Answer::VALUE_IF_CORRECT:
                    $style = 'font-weight:bold; color:green';
                    break;
                case Answer::VALUE_IF_WRONG:
                    $style = 'color:red';
                    break;
                default:
                    $style = 'color:black';
                    break;
            }
            return "<tr style='$style'><td>".$model->user->nick_name." : ".Html::encode($model->answer)."</td><td>".Html::encode($model->result)."</td></tr>";
       },
       'summary'=>'',
       'layout'=>'{items}',
    ]);
    ?>
</div>
