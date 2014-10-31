<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="background-image: url('<?=Yii::$app->request->baseUrl;?>/img/duo-reading.jpg'); width:100%; display:table; ">
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>
        
        <p>Please fill out the following fields to login:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                //'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
        <?= Html::activeLabel($model,'username'); ?>
        <?= Html::activeTextInput($model,'username',['class'=>'form-control']); ?>
        <?php //$form->field($model, 'username') ?>
        <?= Html::activeLabel($model,'password'); ?>
        <?= Html::activePasswordInput($model,'password',['class'=>'form-control']); ?>
        <?php //$form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->checkbox() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?php echo Html::a('Signup',['/site/register'],['class'=>'btn btn-danger', 'style' => "margin-left:13px"]); ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>