<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\widgets\Sidebar;
use common\libraries\UserLibrary;
use common\widgets\ConfirmDialog;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php if(!Yii::$app->user->isGuest) { ?>
    <header class="header clearfix">
        <div class="logo-section">
            <img class="login-logo" src="<?= \Yii::$app->request->baseUrl . "/images/logo.jpeg" ?>" >
        </div>
        <div class="top-right-section">
            <a class="fullview menu-link app-hamburger"></a>
            <div class="top-profile-section">
                <div class="top-profile-name">Hi, <?= \Yii::$app->user->identity->first_name ?> 
                </div>
                <div class="profile-dropdown">
                    <a href="#" class="account">
                        <img src="<?= Yii::$app->request->baseUrl  . "/images/profile-pic'.jpg" ?>" class="profile-circle"/>
                    </a>
                    <div class="submenu" style="display: none;">
                        <ul class="root">
                            <li> 
                                <?= Html::a('Logout',
                                    ['site/logout'],
                                    ['data-method'=>'post']); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </header>

        <div class="main-section clearfix">
            <div class="left-section left-side" id="sidebar">
                <div class="date-time-section clearfix">
                    <?php
                      date_default_timezone_set("Asia/Jakarta");
                      echo date("h:ia");
                      ?>
                      <span><?php echo date("M d");?><br><?php echo date("Y");?>
                      </span>
                </div>
                <div class="menu-section clearfix">
                    <?php if(UserLibrary::isAdmin(\Yii::$app->user->getId())) { ?>
                        <?= Sidebar::widget(['id' => 'cssmenu', 
                                'items' => [
                                    ['label' => 'Kapal',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Kapal', 'href' => Yii::$app->request->baseUrl . "/ship/index"],
                                            ['label' => 'Kepemilikan', 'href' => Yii::$app->request->baseUrl . "/ship/ownership"],
                                            ['label' => 'Kasih Kode Kapal', 'href' => Yii::$app->request->baseUrl . "/ship/assign-code"]
                                        ]
                                    ],
                                    [   
                                        'label' => 'Laporan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Buat Laporan', 'href' => Yii::$app->request->baseUrl . "/report/index"],
                                            ['label' => 'Cek Kapal Laporan', 'href' => Yii::$app->request->baseUrl . "/report/custom"]
                                        ]

                                    ],    
                                    [   
                                        'label' => 'Transaksi',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Transaksi Harian', 'href' => Yii::$app->request->baseUrl . "/transaction/index"],
                                            ['label' => 'Buat Laporan Transaksi', 'href' => Yii::$app->request->baseUrl . "/transaction/custom"],
                                            ['label' => 'Kode Transaksi', 'href' => Yii::$app->request->baseUrl . "/code/index"],
                                        ]

                                    ],    

                                    [   
                                        'label' => 'Penjualan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Buat Penjualan', 'href' => Yii::$app->request->baseUrl . "/selling/index"],
                                            ['label' => 'Cek Jualan Laporan', 'href' => Yii::$app->request->baseUrl . "/selling/custom"]
                                        ]

                                    ],    
                                    [   
                                        'label' => 'Pengguna',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Pemilik Kapal', 'href' => Yii::$app->request->baseUrl . "/owner/index"],
                                        ]
                                    ],
                                    [
                                        'label' => 'Pengaturan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Ganti Password', 'href' => Yii::$app->request->baseUrl . "/user/change-password"]
                                        ]
                                    ]
                                ]
                            ]) ?>
                    <?php } else if(UserLibrary::isOwner (Yii::$app->user->getId())) {?>
                    <?= Sidebar::widget(['id' => 'cssmenu', 
                                'items' => [
                                    [   
                                        'label' => 'Laporan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Cek Kapal Laporan', 'href' => Yii::$app->request->baseUrl . "/report/custom"]
                                        ]

                                    ],    
                                    [   
                                        'label' => 'Transaksi',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Buat Laporan Transaksi', 'href' => Yii::$app->request->baseUrl . "/transaction/custom"],
                                        ]

                                    ],    

                                    [   
                                        'label' => 'Penjualan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Cek Laporan Penjualan', 'href' => Yii::$app->request->baseUrl . "/selling/custom"]
                                        ]

                                    ],
                                    [
                                        'label' => 'Pengaturan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Ganti Password', 'href' => Yii::$app->request->baseUrl . "/user/change-password"]
                                        ]
                                    ]
                                ]
                            ]) ?>
                    <?php } ?>
                </div>
           </div>
            <div class="right-section clearfix">
                <?= $content ?>
            </div>
        </div>
    <?php } else { ?>
        <?= $content ?>
    <?php } ?>
<?php $this->endBody() ?>
<script>require(["project/init"], function() {});</script>
<input id="base-url" type="hidden" value="<?= Yii::$app->request->baseUrl ?>">
<?=ConfirmDialog::widget(['id' => 'confirmdialog']) ?>
</body>

</html>
<?php $this->endPage() ?>
