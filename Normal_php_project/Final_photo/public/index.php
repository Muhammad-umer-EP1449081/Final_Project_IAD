<?php

require_once("../includes/initialize.php");

if($session->is_logged_in()) 
{
  redirect_to("user_home.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit']))
 { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
	
  if ($found_user)
   {
    $session->normal_login($found_user);
		log_action('Login', "{$found_user->username} logged in.");
    redirect_to("user_home.php");
  } 
  else 
  {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} 

if(isset($_POST['register']))
{
  $username = trim($_POST['username_r']);
  $password = trim($_POST['password']);
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $Status = trim("f");

  $sql = "SELECT * FROM users WHERE username = '{$username}'";
$result = USER::find_by_sql($sql);


if($result)
{
$message = "Username already exists please change username and try again";
}


else
{


global $database;
  $sql  = "INSERT INTO users (username, password, first_name, last_name, Status) VALUES ('{$username}','{$password}','{$first_name}','{$last_name}','{$Status}');" ; 
    if($database->query($sql))
     {
      $user_id = $database->insert_id();
      $message = "successfully added";
    } 
    else
     {
      
      $message = "Unsuccessful";
    }

}



}

else
 { // Form has not been submitted.
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
   
  <h1>User Login</h1><span>  <?php echo output_message($message); ?> <a href='#'></a></span>

</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Click Me</div>
  </div>
  <div class="form">
    <h2 >Login to your account</h2>
    <form action="index.php" method="post">
      <input type="text" name="username" placeholder="Username"/>
      <input type="password"  name="password" placeholder="Password"/>
      <button type="submit" name="submit" value="Login">Login</button>
    </form>
  </div>
  <div class="form">
    <h2>Create an account</h2>
    <form action="index.php" method="post">
      <input type="text" placeholder="Username" name="username_r"/>
      <input type="password" placeholder="Password" name="password"/>
      <input type="text" placeholder="First name" name="first_name"/>
      <input type="text" placeholder="Last name" name="last_name"/>
      <button type="submit" name="register" value="register" >Register</button>
    </form>
  </div>
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index1.js"></script>

</body>
</html>
