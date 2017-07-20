<?php

require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) 
{
 redirect_to("index_login.php"); 
}

?>

		
