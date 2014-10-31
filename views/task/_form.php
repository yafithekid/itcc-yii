<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\assets\DateTimePickerAsset;
/* @var $this yii\web\View */
/* @var $model app\models\db\Task */
/* @var $form yii\widgets\ActiveForm */
DateTimePickerAsset::register($this);
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model,'title')->textInput(); ?>
    <?= $form->field($model, 'course_id')->dropDownList(ArrayHelper::map($courses,'id','name')) ?>


    <?= $form->field($model, 'deadline')->textInput(['id'=>'deadline']) ?>
    <?= $form->field($model,'description')->textArea(); ?>
    <?= Html::activeHiddenInput($model,'user_id'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("jQuery('#deadline').datetimepicker({
  format:'Y-m-d H:i:00'
});");
