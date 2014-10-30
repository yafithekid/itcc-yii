<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-md-3 sidebar">
            <?php if (isset(Yii::$app->user->identity)):?>
            <h1><?=Yii::$app->user->identity->fullname;?></h1>
            <?= Nav::widget([
                    'options' => ['class' => 'nav nav-sidebar'],
                    'items' => [
                        ['label' => 'Ubah Profil', 'url' => ['/site/profile','id'=>Yii::$app->user->identity->id]],
                    ],
                ]);
            ?>
            <?php endif; ?>
            <?php
                if(isset(Yii::$app->user->identity) && (Yii::$app->user->identity->isTeacher())) {
                    echo '<h5>Menu Dosen</h5>';
                    echo Nav::widget([
                        'options' => ['class' => 'nav nav-sidebar'],
                        'items' => [
                            ['label' => 'Kuliah', 'url' => ['/course/index']],
                        ],
                    ]);
                }
            ?>
            <?php
                if(isset(Yii::$app->user->identity) && (Yii::$app->user->identity->isAdmin())) {
                    echo '<h5>Menu Admin</h5>';
                    echo Nav::widget([
                        'options' => ['class' => 'nav nav-sidebar'],
                        'items' => [
                            ['label' => 'Pengguna', 'url' => ['/user/index']],
                            ['label' => 'Departemen', 'url' => ['/department/index']],
                            ['label' => 'Fakultas', 'url' => ['/faculty/index']],
                        ],
                    ]);
                }
            ?>
        </div>

        <div id="main-content" class="col-md-9">
            <?= $content ?>
        </div>
    </div>
<?php $this->endContent(); ?>