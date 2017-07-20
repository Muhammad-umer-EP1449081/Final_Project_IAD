<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cm_id') ?>

    <?= $form->field($model, 'message') ?>

    <?= $form->field($model, 'user_id_message') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'conversation_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
