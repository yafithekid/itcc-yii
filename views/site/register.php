<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form col-md-6 col-md-offset-3">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'school')->textInput(['maxlength' => 127]) ?>

    <div class="form-group">
        <?= Html::submitButton('Daftar!', ['class' =>'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
