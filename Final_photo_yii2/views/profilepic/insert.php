<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profilepicture */
/* @var $form ActiveForm */
?>
<div class="profilepic-insert">

    <?php $form = ActiveForm::begin(); ?>

        <!--
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'size') ?>
        <?= $form->field($model, 'type') ?>
        -->

        <?= $form->field($model, 'filename')->fileInput()?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- profilepic-insert -->
