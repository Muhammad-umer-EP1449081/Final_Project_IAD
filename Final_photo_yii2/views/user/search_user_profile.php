
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use app\models\ProfilePicture;
use app\models\relationship;
use app\models\User;

use app\models\photography;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use yii\web\JsExpression;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->title = 'USER TIMELINE POSTS';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="style_home.css" rel="stylesheet" type="text/css" />

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
    

<a href="index.php?r=user"><button type="button" class="btn btn-block btn-primary btn-lg">Search Friend.....</button></a>

        <div class="clr"></div>
      </div>


<?php 


$checking_friend = relationship::find()->where(['status'=> '1'])->andWhere(['or',
           ['user_id_one'=>Yii::$app->user->identity->id],
           ['user_id_two'=>Yii::$app->user->identity->id],
       ])->andWhere(['or',
           ['user_id_one'=>$user_id],
           ['user_id_two'=>$user_id],
       ])->one();


//$checking_friend->orFilterWhere(['like', 'user_id_one', $user_id])
  //          ->orFilterWhere(['like', 'user_id_two', $user_id]);



if(!$checking_friend)
{
  $request_status = relationship::find()->where(['status'=> '0'])->andWhere(['and',
           ['user_id_one'=> Yii::$app->user->identity->id],
           ['user_id_two'=> $user_id],
       ])->one();
}


?>








      <div class="clr"></div>


      <div class="menu_nav">
       
        <?php 

     $profile_pic =  ProfilePicture::find()->where(['user_id'=>$user_id])->one();

     //echo $profile_pic->filename;
              
        ?>

       
<?php if($checking_friend) : ?>


<a  class="btn btn-primary pull-right" style="color:white;" href="/Final_photo_yii2/web/index.php?r=">Your Friend Click to Unfriend</a>


<?php endif; ?>




<?php if(!$checking_friend) : ?>


<?php if($request_status) : ?>

<!--
<a  class="btn btn-primary pull-right" style="color:white;" href="/Final_photo_yii2/web/index.php?r=">Request Pending Click to cancle</a>

a('Send Friend Request', ['relationship/delte', 'id' => $request_status->id , 'userid'=> $userid]
-->

<?= Html::a('Request Pending Click to cancle', ['relationship/delrequest', 'id' => $request_status->id , 'userid'=> $user_id], [
            'class' => 'btn btn-primary pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to Cancle Friend request?',
                'method' => 'post',
            ],
        ]) ?>





<?php endif; ?>


<?php if(!$request_status) : ?>


  <?= Html::a('Send Friend Request', ['relationship/send', 'userid' => $user_id], [
            'class' => 'btn btn-default pull-right',
            'data' => [
                'confirm' => 'Do you know this person?',
                'method' => 'post',
            ],
        ]) ?>

<!--
<a  class="btn btn-default pull-right" href="/Final_photo_yii2/web/index.php/?r=relationship/send&userid=<?php echo $user_id ?>">Send friend Request</a>
-->

<?php endif; ?>


<?php endif; ?>

        







        <div class="clr"></div>
      </div>
      
      <div class="hbg">

      <?php if($profile_pic) : ?>

  
        <img src="images/<?php echo $profile_pic->filename?>" width="923" height="291" alt="" />
      
<?php endif; ?>

<?php if(!$profile_pic) : ?>

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




<br>

<?php foreach ($posts as $post) :?> 




<h6 class="page-header"></h6>

<?php
$user = User::find()->where(['user_id' => $post->user_id])->one();
?>

<?php if($post->p_status == 'private') : ?>

<?php if($user_id == Yii::$app->user->identity->id): ?>


<p class="post-data"><span class="date"><?php echo $post->date?></span> &nbsp;|&nbsp; Posted by <a href="#"><?php echo $user->username ?></a> &nbsp;|&nbsp;Post Status <a href="#"><?php echo $post->p_status ?></a>

             </p>

<p><?php echo $post->caption?></p>

   <?php if(Yii::$app->user->identity->id == $post->user_id) : ?>


<span class="pull-left">
<a  class="btn btn-default" href="/Final_photo_yii2/web/index.php?r=photograph/update&id=<?php echo $post->id?>">Edit</a>&nbsp; &nbsp;

<?= Html::a('Delete', ['photograph/delete', 'id' => $post->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>


<!--<a  class="btn btn-danger" href="/Final_photo_yii2/web/index.php?r=photograph/delete&id=<?php echo $post->id?>">Delete</a>
-->

</span>

<?php endif; ?>


            <img src="images/<?php echo $post->filename?>" width="613" height="193" alt="" />
            <p class="spec"><a href="/Final_photo_yii2/web/index.php?r=comments/view&id=<?php echo $post->id?>" class="com fr">Comments</a></p>

            <div class="clr"></div>
          

          <br>

<?php endif; ?>

<?php endif; ?>







<?php if($post->p_status == 'public') : ?>
  <p class="post-data"><span class="date"><?php echo $post->date?></span> &nbsp;|&nbsp; Posted by <a href="#"><?php echo $user->username ?></a> &nbsp;|&nbsp;Post Status <a href="#"><?php echo $post->p_status ?></a>

             </p>

<p><?php echo $post->caption?></p>
   <?php if(Yii::$app->user->identity->id == $post->user_id) : ?>
<span class="pull-left">
<a  class="btn btn-default" href="/Final_photo_yii2/web/index.php?r=photograph/update&id=<?php echo $post->id?>">Edit</a>&nbsp; &nbsp;

<?= Html::a('Delete', ['photograph/delete', 'id' => $post->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>


<!--<a  class="btn btn-danger" href="/Final_photo_yii2/web/index.php?r=photograph/delete&id=<?php echo $post->id?>">Delete</a>
-->

</span>
<?php endif; ?>


            <img src="images/<?php echo $post->filename?>" width="613" height="193" alt="" />
            <p class="spec"><a href="/Final_photo_yii2/web/index.php?r=comments/view&id=<?php echo $post->id?>" class="com fr">Comments</a></p>

            <div class="clr"></div>
          

          <br>

<?php endif; ?>
     
<?php endforeach; ?>
 <br>

 <div class="pull-right">
<?= LinkPager::widget(['pagination'=> $pagination]); ?>
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