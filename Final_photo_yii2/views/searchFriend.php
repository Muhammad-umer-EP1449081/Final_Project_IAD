<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\userSearch */
/* @var $form ActiveForm */
?>





<div class="searchFriend">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'globalsearch') ?>
    <!--    <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'full_name') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'auth_key') ?>
        <?= $form->field($model, 'create_Date') ?>
    -->
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- searchFriend -->
