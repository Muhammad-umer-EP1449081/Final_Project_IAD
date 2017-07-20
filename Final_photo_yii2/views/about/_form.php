<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;

//use kartik\date\DatePicker;

use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;


// usage without model

/* @var $this yii\web\View */
/* @var $model app\models\About */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-form">

    <?php $form = ActiveForm::begin(); ?>

<!--
    <?= $form->field($model, 'user_id')->textInput() ?>
-->


<?php 
$type = 'date';
echo $form->field($model, 'date_of_birth')->input($type);

?> 


    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'martial_status')->dropDownList([ 'Married' => 'Married', 'Single' => 'Single', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'Gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
