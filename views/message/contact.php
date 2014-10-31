<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\db\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= $this->render('_add-contact',['model'=>$newContact]); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'contactUser.username',
            'contactUser.fullname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
