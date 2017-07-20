<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\userSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',

    ]); ?>



 <?= $form->field($model, 'globalsearch') ?>


  <!--
    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'full_name') ?>
-->

   <!--
    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

-->
<!--
    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'create_Date') ?>
-->

    <div class="form-group">
        <?= Html::submitButton('Search Friend', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
