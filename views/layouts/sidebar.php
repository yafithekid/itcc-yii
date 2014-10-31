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
            <?php if (isset(Yii::$app->user->identity)):?>
            <?= '<h5>Menu Mahasiswa</h5>'; ?>
            <?= Nav::widget([
                    'options' => ['class' => 'nav nav-sidebar'],
                    'items' => [
                        ['label' => '<span class="glyphicon glyphicon-user"></span> Ubah Profil', 'url' => ['/user/update','id'=>Yii::$app->user->identity->id]],
                        ['label' => '<span class="glyphicon glyphicon-envelope"></span> Pesan', 'url' => ['/message/index']],
                        ['label' => '<span class="glyphicon glyphicon-book"></span> Daftar Kuliah Tersedia', 'url' => ['/course/index']],
                        ['label' => '<span class="glyphicon glyphicon-pencil"></span> Tugas', 'url' => ['/task/student','id'=>Yii::$app->user->identity->id]],
                    ],
                    'encodeLabels'=>false,

                ]);
            ?>
            <?php endif; ?>
            <?php
                if(isset(Yii::$app->user->identity) && (Yii::$app->user->identity->isTeacher())) {
                    echo '<h5>Menu Dosen</h5>';
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
                    echo '<h5>Menu Admin</h5>';
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

        <div id="main-content" class="col-md-9">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="col-md-8"><?= $content ?></div>
           
            <div class="col-md-4">
                <div class="well well-sm">
                    <h5><span class='glyphicon glyphicon-globe'></span> Pengguna online</h5>
                    <?php foreach ($online_users as $user): ?>
                        <?= $user->fullname."<br>"; ?>
                    <?php endforeach; ?>
                </div>
                <div class="well well-sm">
                    <h5><span class='glyphicon glyphicon-time'></span> Pengguna login</h5>
                    <?php
                        foreach ($last_login_users as $user): ?>
                        <?= $user->fullname."<br>"; ?>
                    <?php endforeach;?>
                </div>
            </div>
            
        </div>
    </div>
<?php $this->endContent(); ?>