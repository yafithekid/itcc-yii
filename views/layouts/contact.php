<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

?>

<?php $this->beginContent('@app/views/layouts/sidebar.php'); ?>
<?php Pjax::begin(); ?>
<p>
        <?= Html::a('Refresh', ['index'], ['class' => 'btn btn-success']) ?>
    </p>
        <div id="main-content" class="col-md-8">
            <?= $content ?>
        </div>

        <div class='col-md-3'>
        </div>
<?php Pjax::end(); ?>
<?php $this->endContent(); ?>