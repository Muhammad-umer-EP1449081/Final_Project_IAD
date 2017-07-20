<?php
require_once("../../includes/initialize.php");


if($session->is_logged_in()) 
{
  redirect_to("photo_list.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_user = User::aauthenticate($username, $password);
	
  if ($found_user)
   {
    $session->login($found_user);
		log_action('Login', "{$found_user->username} logged in.");
    redirect_to("photo_list.php");
  } else
   {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title></title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style1.css">



  
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  



  <h1 class="logo_colour" >ADMIN LOGIN</h1><span>  <?php echo output_message($message); ?> <a href='#'></a></span>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Click Me</div>
  </div>
  <div class="form">
    <h2>Login to your account</h2>
    <form action="index_login.php" method="post">
      <input type="text" name="username" placeholder="Username"/>
      <input type="password"  name="password" placeholder="Password"/>
      <button type="submit" name="submit" value="Login">Login</button>
    </form>
  </div>
 
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index1.js"></script>

</body>
</html>
