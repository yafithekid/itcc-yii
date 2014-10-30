<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Faculty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faculty-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => 5]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
