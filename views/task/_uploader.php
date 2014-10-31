<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\assets\DateTimePickerAsset;
/* @var $this yii\web\View */
/* @var $model app\models\db\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->errorSummary($model); ?>
    
    <?= Html::activeHiddenInput($model,'task_id'); ?>
    <?= Html::activeHiddenInput($model, 'user_id'); ?>
    <?= $form->field($model,'_file')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
