<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php

  $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
  
  if(isset($_GET['clear']) )
  {

  	if($_GET['clear'] == 'true')
		{
		file_put_contents($logfile, '');
	  // Add the first log entry
	  log_action('Logs Cleared', "by User ID {$session->user_id}");
    // redirect to this same page so that the URL won't 
    // have "clear=true" anymore
    redirect_to('logfile.php');
}
  }
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
        <h1><a href="photo_list.php"><span class="logo_colour">SOCIAL WEBSITE </span></a></h1>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="photo_list.php">PHOTO LIST</a></li>
          <li><a href="user_list.php">USER LIST</a></li>
          <li><a href="log_file.php">LOG FILE</a></li>
          <li><a href="upload_photo.php">UPLOAD PHOTO</a></li>
          <li><a href="logout.php">LOGOUT</a></li>
          
          
        </ul>
      </nav>
    </header>
    <div id="site_content" style="background: #F0EAE0 url(../images/b2.jpg) repeat fixed;">
      

      <div id="sidebar_container">
        <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="../images/ali.png" style="height: 500px; width : 245px;">
        </div>

        
        <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="../images/zong.png" style="height: 500px; width : 245px;">
        </div>
        <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="../images/ufone.png" style="height: 500px; width : 245px;">
        </div>
        <div class="" style= "margin-left: -30px; margin-top: -10px; height: 500px; width : 500px;">
          
          <img src="../images/jazz.png" style="height: 500px; width : 245px;">
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




      <div id="content"  style="background: #F0EAE0 url(../images/b2.jpg) repeat fixed;">
        <ul class="slideshow">
          <li class="">
    


		

      <img width="706" height="316" src="../images/1.jpg" alt="image one" >

           <!-- <form  class="form-inline"  style=" position: absolute;left: 70% ; top: 80%;" action="photo_upload.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" />
             <p style="display:inline-block; "><input type="file" name="file_upload" /></p>
            <input type="submit" name="submit" value="Upload" style="display:inline-block; "/>
            </form> -->




             </li>
        

        </ul>
    
        <div id="content_item"  style= "background: #F0EAE0 url(../images/b2.jpg) repeat fixed; margin-right: 15px; width:710px;">
    
<br />

<h2>Log File</h2>




<p><a href="logfile.php?clear=true">Clear log file</a><p>

<?php

  if( file_exists($logfile) && is_readable($logfile) && 
			$handle = fopen($logfile, 'r')) {  // read
    echo "<ul class=\"log-entries\">";
		while(!feof($handle)) {
			$entry = fgets($handle);
			if(trim($entry) != "") {
				echo "<li>{$entry}</li>";
			}
		}
		echo "</ul>";
    fclose($handle);
  } else {
    echo "Could not read from {$logfile}.";
  }

?>



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
