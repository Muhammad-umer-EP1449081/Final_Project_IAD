<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profilepicture */
/* @var $form ActiveForm */
?>
<div class="profilepic-update">

    <?php $form = ActiveForm::begin(); ?>
      <?=  $form->errorSummary($profilepicture); ?>
     
        <?= $form->field($profilepicture,'filename')->fileInput()?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>