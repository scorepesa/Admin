<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use mdm\admin\components\Helper;

AppAsset::register($this);
//Yii::setAlias('@backend', 'http://www.bsourcecode.com');
//echo Url::to('@backend');
/* @var $this \yii\web\View */
/* @var $content string */
/*
use yii\dependencies
*/
//Register class
if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    ramosisw\CImaterial\web\MaterialAsset::register($this);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('../logo.png', ['style' => "margin-top: -17px;height: 52px;width: 85px;", 'title' => 'Logo',
                    'alt' => 'SCOREPESA!',]),
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $messaging_droplist = '';
            $outcome_droplist = '';
            $settings_dropdown_list = '';
            $reports_dropdown = '';
            $vreports_dropdown = '';

            //canAccessReports

            if (Yii::$app->user->isGuest) {
                /*$menu_items[] = ['label' => 'Signup', 'url' => ['/site/signup']];*/
                $menu_items[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems = [
                    ['label' => 'Match', 'url' => ['/match/index']],
                    ['label' => 'Bets', 'url' => ['/bet/index']]
                ];

                $reports_dropdown .='<li>';

                //if (\Yii::$app->user->can('canAccessScorepesaReports')) {
                    $reports_dropdown .= Html::beginForm(['/reportico-report/index'], 'post')
                        . Html::submitButton(
                                'ScorepesaReports', ['class' => 'btn btn-default btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                        )
                        . Html::endForm();
                //}

                if (\Yii::$app->user->can('canAccessVirtualReports')) {
                    $reports_dropdown .= '<li class="divider"></li>'
                        . Html::beginForm(['/reportico-report/virtuals'], 'post')
                        . Html::submitButton(
                                'VirtualsReports', ['class' => 'btn btn-info btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                        )
                        . Html::endForm();
                }

                $reports_dropdown .='</li>';
                //if (\Yii::$app->user->can('canAccessReports')) {
                    #$menuItems[] = ['label' => 'Reports',
                        #'url' => [$reports_dropdown],
                        
                    #    'url' => ['/reportico-report/index'],
                    #];
                //}

                $messaging_droplist .='<li>';

                $messaging_droplist .= Html::beginForm(['/inbox/index'], 'post')
                        . Html::submitButton(
                                'Inbox', ['class' => 'btn btn-default btn-xs']
                        )
                        . Html::endForm()
                        . '<li class="divider"></li>'
                        . Html::beginForm(['/outbox/index'], 'post')
                        . Html::submitButton(
                                'Outbox', ['class' => 'btn btn-info btn-xs']
                        )
                        . Html::endForm();

                $messaging_droplist .='</li>';

                //if (\Yii::$app->user->can('canAccessMessaging')) {
                  #  $menuItems[] = ['label' => 'Messaging',
                  #      'items' => [$messaging_droplist],
                   # ];
                //}
                $menuItems[] = ['label' => 'Oubox',
                        'url' => ['/outbox/index'],
                    ];

                $menuItems[] = ['label' => 'Profiles', 'url' => ['/profile/index']];
                $menuItems[] = ['label' => 'Jackpot', 'url' => ['/jackpot-event/index']];
                $menuItems[] = ['label' => 'Deposits', 'url' => ['/mpesa-transaction/index']];
                $menuItems[] = ['label' => 'Withdrawals', 'url' => ['/withdrawal/index']];
                $menuItems[] = ['label' => 'Results','url' => ['/outcome/index']];
                //$menuItems[] = ['label' => 'Shop', 'url' => ['/shop-deposits/index']];
                $menuItems[] = ['label' => 'Reports','url' => ['/reportico-report/index']];
                $menuItems[] = ['label' => 'Logout','url' => ['/site/logout']];

                             

                $outcome_droplist .='<li>';
                
                $outcome_droplist .= Html::beginForm(['/outcome/index'], 'post')
                        . Html::submitButton(
                                'Outcomes list', ['class' => 'btn btn-default btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                        )
                        . Html::endForm()
                        . '<li class="divider"></li>'
                        //. '<li class="dropdown-header"></li>'
                        . Html::beginForm(['/outcome/resulting'], 'post')
                        . Html::submitButton(
                                'resulting', ['class' => 'btn btn-info btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                        )
                        . Html::endForm()
                        . '<li class="divider"></li>'
                        . Html::beginForm(['/bleague-match/index'], 'post')
                        . Html::submitButton(
                                'Scorepesa specials', ['class' => 'btn btn-success btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                        )
                        . Html::endForm();

                $outcome_droplist .='</li>'; 
                //if (\Yii::$app->user->can('canAccessResulting')) {
                  #      $menuItems[] = ['label' => 'Resulting', 'items' => [$outcome_droplist]];

                //}
//                $menuItems[] = ['label' => 'Backend', 'url' => ['@backend']];

                $settings_dropdown_list .= '<li>';
                //forms
                $settings_dropdown_list .= Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-danger btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                        )
                        . Html::endForm()
                        . '<li class="divider"></li>'
                        . '<li class="dropdown-header">Change password?</li>'
                        . Html::beginForm(['/site/reset'], 'post')
                        . Html::submitButton(
                                'ResetPassword', ['class' => 'btn btn-warning btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                        )
                        . Html::endForm();

                if (\Yii::$app->user->can('canUploadAPK')) {
                    $settings_dropdown_list .= '<li class="divider"></li>'
                            . Html::beginForm(['site/bapk-upload'], 'post')
                            . Html::submitButton(
                                    'UploadApk', ['class' => 'btn btn-info btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                            )
                            . Html::endForm();
                }

                //if (\Yii::$app->user->can('canAccessSignUp')) {
                    $settings_dropdown_list .= '<li class="divider"></li>'
                            . '<li class="dropdown-header">Create user account?</li>'
                            . Html::beginForm(['/site/signup'], 'post')
                            . Html::submitButton(
                                    'Signup', ['class' => 'btn btn-info btn-xs', 'data-toggle' => 'confirmation', 'data-placement' => "top"]
                            )
                            . Html::endForm();
                //}

                $settings_dropdown_list .= '</li>';

                $menuItems[] = ['label' => 'Settings',
                    'items' => [$settings_dropdown_list],
                ];

                $menu_items = Helper::filter($menuItems);
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menu_items,
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

                <div id="overlay" class="preload" align="center">
                    <img src="../loading.gif">
                </div>
                <?= $content ?>
            </div>

            <!--Get all flash messages and loop through them-->
            <?php Yii::$app->session->getAllFlashes(); ?>

        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Scorepesa <?= date('Y') ?></p>


            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
