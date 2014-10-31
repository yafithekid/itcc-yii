<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => 127]) ?>

    <?= $form->field($model, 'school')->textInput(['maxlength' => 127]) ?>
    <?php if (Yii::$app->user->identity->isAdmin()): ?>
    <h3>Hak akses</h3>

    <?= $form->field($model, 'is_admin')->checkBox() ?>

    <?= $form->field($model, 'is_teacher')->checkBox() ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
