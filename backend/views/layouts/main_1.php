<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

rmrevin\yii\fontawesome\AssetBundle::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon2.png" type="image/x-icon" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Dlt-Department Land Of Transport',
                'brandLabel' => Html::img('@web/images/logoh50.png', ['alt' => Yii::$app->name]),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-police navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
                Yii::$app->user->isGuest ?
                        ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']] :
                        ['label' => 'Welcome (' . Yii::$app->user->identity->username . ')',
                    //['label' => 'ดำเนินการยื่นขอขึ้นทะเบียน', 'url' => Yii::$app->urlManagerBackend->createUrl(['site/index'])],
                    'items' => [
                        //['label' => 'ดำเนินการยื่นขอขึ้นทะเบียน', 'url' => Yii::$app->urlManagerBackend->createUrl(['site/index'])],
                        ['label' => 'ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
                        ['label' => 'ตั้งค่า', 'url' => ['/user/settings/account']],
                        ['label' => 'ออกจากระบบ', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ]],
                ['label' => 'ลงทะเบียน', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
            ];
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => [

                    'class' => 'navbar-nav navbar-right'
                ],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
                    <?php
                    echo \kartik\widgets\Growl::widget([
                        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
                        'showSeparator' => true,
                        'delay' => 1, //This delay is how long before the message shows
                        'pluginOptions' => [
                            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                            'placement' => [
                                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'center',
                            ]
                        ]
                    ]);
                    ?>
                <?php endforeach; ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="dltfooter">
            <div class="container">
                <p class="pull-left">&copy; <?= Yii::powered() ?>  <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
