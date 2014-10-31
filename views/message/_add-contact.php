<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Contact */
/* @var $form yii\widgets\ActiveForm */
$model->current_user_id = Yii::$app->user->identity->id;
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'username')->textInput() ?>

    <?= Html::activeHiddenInput($model, 'current_user_id'); ?>

    <div class="form-group">
        <?= Html::submitButton('Tambah',['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
