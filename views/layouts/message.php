<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\models\db\User;
$online_users = User::find()->where(['is_online'=>1])->all();
$last_login_users = User::find()->where(['is_online'=>0])->orderBy(['last_login' => SORT_DESC])->limit(10)->all();

?>

<?php $this->beginContent('@app/views/layouts/sidebar.php'); ?>
    
    <?= Nav::widget([
            'options' => ['class' => 'nav nav-tabs'],
            'items' => [
                ['label' => 'Inbox', 'url' => ['/message/inbox']],
                ['label' => 'Sent', 'url' => ['/message/sent']],
                ['label' => 'Contact','url'=>['/message/contact']],
            ],
        ]);
    ?>
    <?= $content; ?>
            
<?php $this->endContent(); ?>