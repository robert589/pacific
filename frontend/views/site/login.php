<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\LoginForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="lgn" class="login clearfix">
    <div class="main-heading login-heading clearfix">
        Admin log in
    </div>
    <div class="login-form" >
        <h4>Log in</h4>
        <?= LoginForm::widget(['id' => 'lgnform']) ?>
    </div>  
</div>
    