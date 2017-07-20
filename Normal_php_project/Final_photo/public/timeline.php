<?php 
require_once("../includes/initialize.php"); ?>
<?php


if(!$session->is_logged_in()) 
{
  redirect_to("index.php");
}


if(isset($_POST['submit'])) 
  {


  $u_id = $_SESSION['user_id'];
  
  $sql1 = "SELECT * FROM profile_picture ";
  $sql1 .= "WHERE user_id = '2'";
  
  $profile_pic = Profilepicture::find_by_id($u_id);



  if($profile_pic)
  {


$profile_pic->attach_file($_FILES['file_upload']);

$profile_pic->update_pp();




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




if(isset($_POST['submit2'])) 
  {
    $photo = new Photograph();
    $photo->caption = $_POST['caption1'];
    $photo->user_id = $_SESSION['user_id'];
    $photo->attach_file($_FILES['file_upload1']);

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
  

	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 3;

	// 3. total record count ($total_count)
	$total_count = Photograph::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	//global $session;


	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM photographs ";

	$photos = Photograph::find_by_sql($sql);
	
  $u_id = $_SESSION['user_id'];
  
  $profile_pic = Profilepicture::find_by_id($u_id);


	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>CSS3_design_two </title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  
  <link rel="stylesheet" type="text/css" href="css/style_timeline.css" />

  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <!-- class="logo_colour", allows you to change the colour of the text -->
        <h1><a href="user_home.php"><span class="logo_colour">SOCIAL WEBSITE </span></a></h1>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="user_home.php">HOME</a></li>
          <li><a href="timeline.php">TIMELINE</a></li>
           <li><a href="logout.php">LOGOUT</a></li>
          
          
        </ul>
      </nav>
    </header>
    <div id="site_content">
      

      <div id="sidebar_container">
       <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="images/ali.png" style="height: 500px; width : 245px;">
        </div>

        
        <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="images/zong.png" style="height: 500px; width : 245px;">
        </div>
        <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="images/ufone.png" style="height: 500px; width : 245px;">
        </div>
        <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="images/jazz.png" style="height: 500px; width : 245px;">
        </div>
        <div class="sidebar">
          <h1>Special Offers</h1>
          <h2>20% Discount</h2>
          <p>For the month of July 2012, we are offering a 20% discount for all new visitors.</p>
        </div>
        <div class="sidebar">
          <h1>Contact Us</h1>
          <p>We'd love to hear from you. Call us, <a href="#">email us</a> or complete our <a href="contact.php">contact form</a>.</p>
        </div>
      </div>




      <div id="content">
        <ul class="slideshow">
          <li class="">
      <img width="706" height="316" src="<?php echo $profile_pic->image_path()?>" alt="image one" >

           <!-- <form  class="form-inline"  style=" position: absolute;left: 70% ; top: 80%;" action="photo_upload.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" />
             <p style="display:inline-block; "><input type="file" name="file_upload" /></p>
            <input type="submit" name="submit" value="Upload" style="display:inline-block; "/>
            </form> -->



 <form action="timeline.php" enctype="multipart/form-data" method="POST"   role="form"  style=" position: absolute;left: 65% ; top: 65%;"  enctype="multipart/form-data" >
              <div class="box-body">
                
                
                <div class="form-group">
                  <label for="exampleInputFile" style=" color: white;">Edit Profile pic</label>
                  <input type="hidden" name="MAX_FILE_SIZE" />
                  <input type="file" name="file_upload">

                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" value="Upload" class="btn btn-primary">Upload</button>
              </div>
            </form>



             </li>
        

        </ul>
    
        <div id="content_item"  style= "background: #F0EAE0 url(images/b2.jpg) repeat fixed; margin-right: 0px; width:710px;">
    



    <h1>YOUR TIMELINE POSTS</h1>


  <form action="timeline.php" enctype="multipart/form-data" method="POST"   role="form"  style=" margin-top : 10px; margin-left: 10px;"  enctype="multipart/form-data" >
              <div class="box-body" style="background: #F0EAE0 url(images/b2.jpg) repeat fixed;">
                
                
                <div class="form-group">
                  <label for="exampleInputFile" style=" color: black;">UPLOAD PICTURE</label>
                  <input type="hidden" name="MAX_FILE_SIZE" />
                  <input type="file" name="file_upload1">
                      
                  <p style=" margin-top : 10px; margin-left: 0px;">Caption: <input type="text" name="caption1" value="" /></p>

                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit2" value="Upload" class="btn btn-primary">Upload</button>
              </div>
            </form>


<!-- 
<?php foreach($photos as $photo): ?>
  <div style="float: left; margin-left: 20px; border-style: solid;
    border-color: #ff0000 #0000ff;">
    <a href="photo.php?id=<?php echo $photo->id; ?>">
      <img src="<?php echo $photo->image_path(); ?>" width="200" />
    </a>
    <p><?php echo $photo->caption; ?></p>
  </div>

<?php endforeach; ?>
  -->



<?php foreach($photos as $photo): ?>
  

  <div style="float: left; background: #F0EAE0 url(images/b2.jpg) repeat fixed; margin-left: -25px; margin-right:5px;  ">
    <h2 style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php echo $photo->caption; ?></h2>
    <a href="photo.php?id=<?php echo $photo->id; ?>">
      <img  style="margin-left: 20%;  width: 60%;" src="<?php echo $photo->image_path(); ?>" width="200" />
    </a>
    <hr>
  </div>

<?php endforeach; ?>


                
   <!--           
<div >
    
    <h2 style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php echo $photos[0]->caption; ?></h2>
    <a href="photo.php?id=<?php echo $photos[0]->id; ?>">
      <img  style="margin-left: 20%;  width: 60%;" src="<?php echo $photos[0]->image_path(); ?>" width="200" />
    </a>

  </div>



<div >
    
    <h2 style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php echo $photos[1]->caption; ?></h2>
    <a href="photo.php?id=<?php echo $photos[1]->id; ?>">
      <img  style="margin-left: 20%;  width: 60%;" src="<?php echo $photos[1]->image_path(); ?>" width="200" />
    </a>
  </div>


  <div >
    <h2 style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php echo $photos[2]->caption; ?></h2>
    <a href="photo.php?id=<?php echo $photos[2]->id; ?>">
      <img  style="margin-left: 20%;  width: 60%;" src="<?php echo $photos[2]->image_path(); ?>" width="200" />
    </a>
  </div>
-->






        </div>


      </div>
    </div>






    <footer>
      
    </footer>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/image_fade.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>
</body>
</html>
