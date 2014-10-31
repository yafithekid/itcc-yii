<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\db\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Buat Pesan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class='table table-striped table-condensed'>
    <tr>
        <th>Waktu</th>
        <th>Pesan</th>
        <th>Lihat</th>
    </tr>
    <?= ListView::widget([
       'dataProvider' => $dataProvider,
       //'itemOptions' => ['class' => 'item'],
       'itemView' => function ($model, $key, $index, $widget) {
            return "<tr><td>".$model->created_at."</td><td>".substr(Html::encode($model->content),0,50)."</td><td>".Html::a("<span class='glyphicon glyphicon-search'",['view','id'=>$model->id])."</td></tr>";
       },
       //'summary'=>'',
       //'layout'=>'{items}',
                    ]);
        ?>
    </table>
    <?php //echo 
    // GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],

    //         'id',
    //         'contact_id',
    //         'content:ntext',
    //         'created_at',

    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]); 
    ?>

</div>
