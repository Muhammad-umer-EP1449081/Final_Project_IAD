<!--
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */

$this->title = 'Update Comments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
-->



<!--

<?php foreach ($comments as $comment) :?> 

<?php $comment_user = User::find()->where(['user_id' => $model->user_id])->one(); ?>

<p class="post-data"><span class="date"><?php echo $comment->created?></span>
 &nbsp;|&nbsp; Comment by 
  <a href="#"><?php echo $comment_user->username ?></a> </p>
  <h3><?php echo $comment->body ?>  

 <?php if(Yii::$app->user->identity->id == $comment->user_id) : ?>
<span class="pull-right">
<a  class="btn btn-default" href="/Final_photo_yii2/web/index.php?r=comments/update&id=<?php echo $comment->id?>">Edit</a>&nbsp; &nbsp;
<a  class="btn btn-danger" href="/Final_photo_yii2/web/index.php?r=comments/update&id=<?php echo $comment->id?>">Delete</a>

</span>
<?php endif; ?>


  </h3>
  
 <br>
     
<?php endforeach; ?>
-->
