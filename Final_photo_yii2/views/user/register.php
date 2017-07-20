
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>


<!--
<div class="user-register">

    <?php $form = ActiveForm::begin(); ?>
      <?= $form->errorSummary($user); ?>

<h2 class="page-header">Register</h2>
      <?=  $form->field($user, 'full_name'); ?>
      <?=  $form->field($user, 'username'); ?>
      <?=  $form->field($user, 'email'); ?>
      <?=  $form->field($user, 'password')->passwordInput(); ?>
      <?=  $form->field($user, 'password_repeat')->passwordInput(); ?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-register -->


<?php

$this->title = 'My Yii Application';
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style_login.css">

  
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Register your Account</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
  </div>
<!--   <div class="form">
    <h2>Login to your account</h2>
    <form>
      <input type="text" placeholder="Username"/>
      <input type="password" placeholder="Password"/>
      <button>Login</button>
    </form>
  </div> -->
  <div class="form">

    <?php $form = ActiveForm::begin(); ?>
      <?= $form->errorSummary($user); ?>
      <?=  $form->field($user, 'full_name'); ?>
      <?=  $form->field($user, 'username'); ?>
      <?=  $form->field($user, 'email'); ?>
       <?php 
$type = 'date';
echo $form->field($user, 'date_of_birth')->input($type);

?> 
      <?=  $form->field($user, 'password')->passwordInput(); ?>
      <?=  $form->field($user, 'password_repeat')->passwordInput(); ?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

  </div>

</div>

    <script src="js/index_login.js"></script>

</body>
</html>



