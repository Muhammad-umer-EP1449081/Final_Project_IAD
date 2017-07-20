<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PhotographySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photography-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    

    <?= $form->field($model, 'globalsearch') ?>

   <!--
    
<?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'size') ?>

    <?= $form->field($model, 'caption') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'p_status') ?>

    <?php // echo $form->field($model, 'date') ?>


-->
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
