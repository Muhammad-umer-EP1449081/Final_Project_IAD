<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("index_login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) 
  {
  	$session->message("No User ID was provided.");
    redirect_to('user_list.php');
  }

  $user = User::find_by_id($_GET['id']);

  if($user && $user->delete()) 
  {
    $session->message("The user {$user->username} was deleted.");
    redirect_to('user_list.php');
  } 
  else 
  {
    $session->message("The user could not be deleted.");
    redirect_to('user_list.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
