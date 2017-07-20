<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Photograph */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photograph-form">

    <?php $form = ActiveForm::begin(); ?>

  <!--  <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?> -->

  <?= $form->field($model, 'filename')->fileInput() ?>

   <!-- <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?> -->

    <?= $form->field($model, 'p_status')->dropDownList([
         'public' => 'public',
         'private' => 'private',
        ], ['prompt' => 'Select status'] )  ?> 

    <?= $form->field($model, 'caption')->textArea(['rows'=> '6']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
