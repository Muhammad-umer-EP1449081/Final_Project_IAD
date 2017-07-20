<?php 
require_once("../includes/initialize.php"); ?>
<?php



if(isset($_POST['submit'])) 
  {


  $u_id = $_SESSION['user_id'];
  
  $sql1 = "SELECT * FROM profile_picture ";
  $sql1 .= "WHERE user_id = '2'";
  
  $profile_pic = Profilepicture::find_by_id($u_id);



  if($profile_pic)
  {


//UPDATE `profile_picture` SET filename = '1.jpg' WHERE user_id = 2


$current_photo = new Photograph();
$current_photo->filename = $_FILES["file_upload"]["name"];
$current_photo->size = $_FILES["file_upload"]["size"];

$sql = "UPDATE profile_picture";
 $sql .= "SET filename = {$_FILES['file_upload']['name']} ,";
 $sql .= "size = {$_FILES['file_upload']['size']}";
$sql .= "WHERE user_id = 2 ; ";

/*
$sql= "UPDATE ";
$sql .= "SET filename = {$current_filename} , ";
$sql  .= "size = {$current_size}";
$sql  .="WHERE user_id = {$u_id}";*/


if($result = Profilepicture::find_by_sql_pp($sql))
{
  $message = "successfully uploaded";
}



redirect_to('timeline.php');
  }

  else
  {

$photo = new profilepicture();
    $photo->user_id = $_SESSION['user_id'];
    $photo->attach_file($_FILES['file_upload']);

    if($photo->save()) 
    {
      // Success
      $session->message("Photograph uploaded successfully.");
      redirect_to('timeline.php');
    } 

    else 
    {
      // Failure
      $message = join("<br />", $photo->errors);
    }


  }




    
  }
  ?>