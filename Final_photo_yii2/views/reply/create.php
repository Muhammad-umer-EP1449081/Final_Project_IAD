<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use app\models\ProfilePicture;
use app\models\User;

use app\models\relationship;
use app\models\photography;


use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use yii\web\JsExpression;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->title = 'ALL MESSAGES';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="style_home.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" src="js/jquery-1.3.2.min_home.js"></script>
<script type="text/javascript" src="js/script_home.js"></script>
<script type="text/javascript" src="js/cufon-yui_home.js"></script>
<script type="text/javascript" src="js/arial_home.js"></script>
<script type="text/javascript" src="js/cuf_run_home.js"></script>
</head>
<body class="body1">
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Social</span>Net<small>Simple web template</small></a></h1>
      </div>
      <div class="search">
    

<a href="index.php?r=user/"><button type="button" class="btn btn-block btn-primary btn-lg">Search Friend.....</button></a>

        <div class="clr"></div>
      </div>
      <div class="clr"></div>


      <div class="menu_nav">
       
        <?php 

        $user_id = Yii::$app->user->identity->id ;

     $profile_pic =  ProfilePicture::find()->where(['user_id'=>$user_id])->one();

     //echo $profile_pic->filename;
              
        ?>

        <div class="clr"></div>
      </div>
      <div class="hbg">

<?php if($profile_pic) : ?>

   <a  class="btn btn-default" href="/Final_photo_yii2/web/index.php/?r=profilepic/update&id=<?php echo $profile_pic->pp_id?>">Change Profile picture</a>
        <img src="images/<?php echo $profile_pic->filename?>" width="923" height="291" alt="" />
      
<?php endif; ?>

<?php if(!$profile_pic) : ?>

   <a  class="btn btn-default" href="/Final_photo_yii2/web/index.php/?r=profilepic/insert">Change Profile picture</a>
        <img src="images/2.jpg" width="923" height="291" alt="" />
      
<?php endif; ?>


      </div>

    </div>
    <div class="content">
      <div class="content_bg">



<div class="sidebar pull-left" >
          <div class="gadget">
            <h2 class="star"><span>Click Friend</span> To Chat</h2>
            <div class="clr"></div>
            <br>

<?php

 $all_friends = relationship::find()->where(['status'=> '1'])->andWhere(['or',
           ['user_id_one'=>Yii::$app->user->identity->id],
           ['user_id_two'=>Yii::$app->user->identity->id],
       ])->all();
  

?>
            <ul class="sb_menu">

<!--
              <li class="active"><a href="#">Home</a></li> 
              <li><a href="#">TemplateInfo</a></li>
              <li><a href="#">Style Demo</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Archives</a></li>
              <li><a href="#">Web Templates</a></li>
    
    

<?php foreach ($all_friends as $friend) :?> 

<li class="#"><a href="#"><?php  ?> </a></li> 

<?php endforeach; ?>
   -->


<?php foreach($all_friends as $friend) : ?>



<?php

$user_friend = Yii::$app->user->identity->id;

$user_friend = $user_friend.''; 

if($friend->user_id_one == $user_friend)
{

$user_friend =  $friend->user_id_two ;


}

elseif($friend->user_id_two == $user_friend)
{

$user_friend =  $friend->user_id_one ;


}



$user = User::find()->where(['user_id' => $user_friend])->one();

$request_user_pic =  ProfilePicture::find()->where(['user_id'=>$user->user_id])->one();



?>


<!--
            <p class="post-data">
              
               
                 <img src="images/<?php echo $request_user_pic->filename?>" width="70" height="70" alt="" />
                 <a href="#" style="color:blue;" ><?php echo $user->username ?></a>
                &nbsp;|&nbsp; became friend &nbsp;|&nbsp;
               <span class="date"><?php echo $friend->date?></span>
                &nbsp;|&nbsp;

<a  class="btn btn-primary" style="color:white;" href="/Final_photo_yii2/web/index.php?r=user/profile&userid=<?php echo $user_friend ?>">Friend Timeline</a>
             
             </p>

-->


<li class="#">


<a href="/Final_photo_yii2/web/index.php?r=reply/create&con_user=<?php echo $user->user_id?>" style="color:black;" >

<img src="images/<?php echo $request_user_pic->filename?>" width="50" height="50" alt="" />

 &nbsp;&nbsp;
<?php echo $user->username ?>


</a>





</li> 


  <?php endforeach; ?>



            </ul>



          </div>
          
<!--
          <div class="gadget">
            <h2 class="star"><span>Sponsors</span></h2>
            <div class="clr"></div>
            <ul class="ex_menu">
              <li><a href="http://www.dreamtemplate.com">DreamTemplate</a><br />
                Over 6,000+ Premium Web Templates</li>
              <li><a href="http://www.templatesold.com/">TemplateSOLD</a><br />
                Premium WordPress &amp; Joomla Themes</li>
              <li><a href="http://www.imhosted.com">ImHosted.com</a><br />
                Affordable Web Hosting Provider</li>
              <li><a href="http://www.myvectorstore.com">MyVectorStore</a><br />
                Royalty Free Stock Icons</li>
              <li><a href="http://www.evrsoft.com">Evrsoft</a><br />
                Website Builder Software &amp; Tools</li>
              <li><a href="http://www.csshub.com/">CSS Hub</a><br />
                Premium CSS Templates</li>
            </ul>
          </div>

-->
<!--
          <div class="gadget">
            <h2 class="star"><span>Wise Words</span></h2>
            <div class="clr"></div>
            <div class="testi">
              <p><span class="q"><img src="images/qoute_1.gif" width="20" height="15" alt="" /></span> We can let circumstances rule us, or we can take charge and rule our lives from within. <span class="q"><img src="images/qoute_2.gif" width="20" height="15" alt="" /></span></p>
              <p class="title"><strong>Earl Nightingale</strong></p>
            </div>
          </div>

-->

<!--
          <div class="gadget">
            <h2 class="star"><span>Wise Words</span></h2>
            <div class="clr"></div>
            <div class="testi">
              <p><span class="q"><img src="images/qoute_1.gif" width="20" height="15" alt="" /></span> We can let circumstances rule us, or we can take charge and rule our lives from within. <span class="q"><img src="images/qoute_2.gif" width="20" height="15" alt="" /></span></p>
              <p class="title"><strong>Earl Nightingale</strong></p>
              <p><span class="q"><img src="images/qoute_1.gif" width="20" height="15" alt="" /></span> We can let circumstances rule us, or we can take charge and rule our lives from within. <span class="q"><img src="images/qoute_2.gif" width="20" height="15" alt="" /></span></p>
              <p class="title"><strong>Earl Nightingale</strong></p>

            </div>
          </div>

-->
        </div>









<div class="mainbar">



          <div class="article">
            


<h1><?= Html::encode($this->title) ?></h1>
            </div>






            <div class="clr"></div>



<?php 


$user_chat = User::find()->where(['user_id' => $chatid])->one();

$request_user_pic_chat =  ProfilePicture::find()->where(['user_id'=>$user_chat->user_id])->one();



?>



   <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
        <img src="images/<?php echo $request_user_pic_chat->filename?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        
        <h4><?php echo $user_chat->username ?></h4><br>


<?php foreach($querys as $query) : ?>


        <hr class="w3-clear">
        <h4><?php echo $query->message ; ?></h4>
         

<?php 

$user_message = User::find()->where(['user_id' => $query->user_id_message])->one();

?>


         <p class="direct-chat-timestamp pull-left" style="color:gray;"><?php echo $user_message->username; ?></p>
         <p class="direct-chat-timestamp pull-right" style="color:gray;"><?php echo $query->time; ?></p>
 
        <div class="clr"></div>      
  <hr class="w3-clear">

<?php endforeach; ?>      



<div class="reply-create">

<!--
    <h1><?= Html::encode($this->title) ?></h1>
-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


      </div>






</div>
       

        
        <div class="clr"></div>

         <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2><span>Image Gallery</span></h2>
        <a href="#"><img src="images/pic_1.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/pic_2.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/pic_3.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/pic_4.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/pic_5.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/pic_6.jpg" width="58" height="58" alt="" /></a> </div>
      <div class="col c2">
        <h2><span>Lorem Ipsum</span></h2>
        <p>Lorem ipsum dolor<br />
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.</p>
      </div>
      <div class="col c3">
        <h2><span>About</span></h2>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo. llorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum. <a href="#">Learn more...</a></p>
      </div>
      <div class="clr"></div>
    </div>
  </div>


      </div>
    </div>
  </div>
 
</div>
<div class="footer">
  <div class="footer_resize">
    <p class="lf">&copy; Copyright <a href="#">MyWebSite</a>.</p>
    <p class="rf">Layout by Rocket <a href="http://www.rocketwebsitetemplates.com/">Website Templates</a></p>
    <div class="clr"></div>
  </div>
</div>
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>


