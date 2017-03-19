<?php

/* @var $this \yii\web\View */
/* @var $content string */
use common\widgets\EmptyModal;
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
                        <?= Sidebar::widget(['id' => 'cssmenu', 
                                'items' => [
                                    [
                                        'label' => 'Dashboard',
                                        'href' => Yii::$app->request->baseUrl . "/dashboard/index"
                                    ],
                                    [   
                                        'label' => 'Transaksi',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Transaksi Harian', 
                                             'href' => Yii::$app->request->baseUrl . "/transaction/index"],
                                            ['label' => 'Buat Laporan Transaksi', 
                                             'href' => Yii::$app->request->baseUrl . "/transaction/custom"],
                                        ]

                                    ],    

                                    [   
                                        'label' => 'Penjualan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Buat Penjualan', 
                                             'href' => Yii::$app->request->baseUrl . "/selling/index"],
                                            ['label' => 'Cek Jualan Laporan', 
                                             'href' => Yii::$app->request->baseUrl . "/selling/custom"]
                                        ]

                                    ],   
                                    [   
                                        'label' => 'Pembelian',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Daftar Pembelian', 
                                             'href' => Yii::$app->request->baseUrl . "/purchase/index"],
                                            ['label' => 'Buat Pembelian', 
                                             'href' => Yii::$app->request->baseUrl . "/purchase/add"],
                                        ]

                                    ],   

                                    [   
                                        'label' => 'Inventaris',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Daftar Aset', 
                                             'href' => Yii::$app->request->baseUrl . "/inventory/index"],
                                            ['label' => 'Buat Aset', 
                                             'href' => Yii::$app->request->baseUrl . "/inventory/create"]
                                        ]

                                    ],  
                                    [   
                                        'label' => 'Pengguna',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Daftar Pengguna', 
                                             'href' => Yii::$app->request->baseUrl . "/user/list"],
                                            ['label' => 'Daftar Jabatan', 
                                             'href' => Yii::$app->request->baseUrl . "/user/role"]
                                        ]
                                    ],
                                    [
                                        'label' => 'Kode',
                                        'href' => Yii::$app->request->baseUrl . "/code/index"
                                    ],
                                    [
                                        'label' => 'Pengaturan',
                                        'href' => '#',
                                        'items' => [
                                            ['label' => 'Umum', 'href' => Yii::$app->request->baseUrl . "/setting/index"],
                                            ['label' => 'Ganti Password', 'href' => Yii::$app->request->baseUrl . "/user/change-password"]
                                        ]
                                    ]
                                ]
                            ]) ?>
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
