<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchForm */
/* @var $form ActiveForm */
?>
<div class="searchuser">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- searchuser -->
