<?php 
require_once("../includes/initialize.php"); ?>
<?php


if(!$session->is_logged_in()) 
{
  redirect_to("index.php");
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
  

  $sql1 = "SELECT * FROM profile_picture ";
  $sql1 .= "WHERE user_id = {$u_id}";
  
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



             </li>
        

        </ul>
    
        <div id="content_item"  style= "background: #F0EAE0 url(images/b2.jpg) repeat fixed; margin-right: 0px; width:710px;">
    



    <h1>ALL USERS POSTS</h1>





<?php foreach($photos as $photo): ?>
  

  <div style="float: left; background: #F0EAE0 url(images/b2.jpg) repeat fixed; margin-left: -25px; margin-right:5px;  ">
		<h2 style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php echo $photo->caption; ?></h2>
		<p>POSTED BY : <?php 

          $photo_user = $photo->user_id;
         $user =  User::find_by_id($photo_user);

         echo $user->username;

		?> </p>
    <a href="photo.php?id=<?php echo $photo->id; ?>">
      <img  style="margin-left: 20%;  width: 60%;" src="<?php echo $photo->image_path(); ?>" width="200" />
    </a>
    <hr>
  </div>

<?php endforeach; ?>









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
