<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\conversation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conversation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_one_id')->textInput() ?>

    <?= $form->field($model, 'user_two_id')->textInput() ?>

    <?= $form->field($model, 'first_msg_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
