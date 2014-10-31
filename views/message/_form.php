<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Message */
/* @var $form yii\widgets\ActiveForm */
//var_dump($model);
//exit();
$model->sender_user_id = Yii::$app->user->identity->id;
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(['id'=>'message-form']); ?>

    <?php
    	 //$form->field($model, 'id')->textInput() 
    ?>

    <?php echo Html::activeLabel($model, 'receiver_username');?>
    <?php echo Html::activeTextInput($model, 'receiver_username',['class'=>'form-control']);?><br>
    
    <?php //echo Html::activeLabel($model, 'sender_user_id');?>
    <?php echo Html::activeHiddenInput($model, 'sender_user_id');?><br>

    <?php echo Html::activeLabel($model, 'content');?>
    <?php echo Html::activeTextArea($model, 'content',['class'=>'form-control']);?><br>

    <div class="form-group">
        <?= Html::submitButton('Kirim', ['class' => 'btn btn-primary']);
        //Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
