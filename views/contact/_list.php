<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'contact.contactUsers.fullname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
