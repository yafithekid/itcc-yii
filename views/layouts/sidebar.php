<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\models\db\User;
$online_users = User::find()->where(['is_online'=>1])->all();
$last_login_users = User::find()->where(['is_online'=>0])->orderBy(['last_login' => SORT_DESC])->limit(10)->all();

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-md-3 sidebar">
            <div id="accordion">
            <?php if (isset(Yii::$app->user->identity)):?>
            <?= '<h5><a href=#>Menu Mahasiswa</a></h5>'; ?>
            <?= Nav::widget([
                    'options' => ['class' => 'nav nav-sidebar'],
                    'items' => [
                        ['label' => '<span class="glyphicon glyphicon-user"></span> Ubah Profil', 'url' => ['/user/update','id'=>Yii::$app->user->identity->id]],
                        ['label' => '<span class="glyphicon glyphicon-envelope"></span> Pesan', 'url' => ['/message/inbox']],
                        ['label' => '<span class="glyphicon glyphicon-book"></span> Daftar Kuliah Tersedia', 'url' => ['/course/index']],
                        ['label' => '<span class="glyphicon glyphicon-pencil"></span> Tugas', 'url' => ['/task/student','id'=>Yii::$app->user->identity->id]],
                    ],
                    'encodeLabels'=>false,

                        ]);
                    ?>
                <?php endif; ?>
                <?php
                    if(isset(Yii::$app->user->identity) && (Yii::$app->user->identity->isTeacher())) {
                        echo '<h5><a href=#>Menu Dosen</a></h5>';
                        echo Nav::widget([
                            'options' => ['class' => 'nav nav-sidebar'],
                            'items' => [
                                ['label' => '<span class="glyphicon glyphicon-book"></span> Kuliah Saya', 'url' => ['/course/teacher']],
                                ['label' => '<span class="glyphicon glyphicon-pencil"></span> Tugas Saya', 'url' => ['/task/teacher']],
                            ],
                            'encodeLabels' => false,
                        ]);
                    }
                ?>
                <?php
                    if(isset(Yii::$app->user->identity) && (Yii::$app->user->identity->isAdmin())) {
                        echo '<h5><a href=#>Menu Admin</a></h5>';
                        echo Nav::widget([
                            'options' => ['class' => 'nav nav-sidebar'],
                            'items' => [
                                ['label' => '<span class="glyphicon glyphicon-user"></span> Pengguna', 'url' => ['/user/index']],
                                ['label' => 'Departemen', 'url' => ['/department/index']],
                                ['label' => 'Fakultas', 'url' => ['/faculty/index']],
                            ],
                            'encodeLabels' => false,
                        ]);
                    }
                ?>
            </div>
        </div>
        <div id="main-content" class="col-md-9">
            <div class="col-md-8"><?= $content ?></div>
           
            <div class="col-md-4">
                <h5><span class='glyphicon glyphicon-globe'></span> Pengguna online</h5>
                <div class="sidebar-kanan">
                    <?php foreach ($online_users as $user): ?>
                        <?= $user->fullname."<br>"; ?>
                    <?php endforeach; ?>
                </div>
                <h5><span class='glyphicon glyphicon-time'></span> Pengguna login</h5>
                <div class="sidebar-kanan">
                    <?php
                        foreach ($last_login_users as $user): ?>
                        <?= $user->fullname."<br>"; ?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
         <script>
            window.onload = function(){
                $("#accordion h5").next().hide();
                $("#accordion h5").click(function() {
                    $(this).next().slideToggle();
                });
            };
        </script>
        <style type="text/css">
            #accordion h5 {
                background-color: #f5f5f5;
                padding: 5px;
            }
        </style>
    </div>
<?php $this->endContent(); ?>