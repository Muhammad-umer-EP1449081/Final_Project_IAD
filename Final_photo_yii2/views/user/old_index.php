<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\userSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php if($searchModel->globalsearch): ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            //'full_name',
            //'username',
            //'email:email',
            
             
    [
       'attribute' => 'Click to visit Profile',
      'format' => 'raw',
      'value' => function ($searchModel)
       {
        $id = $searchModel->user_id;
        return '<a href="/Final_photo_yii2/web/index.php?r=user/profile&userid=' .$id.'" >'.$searchModel->username.'</a>';
      },

    ],
    'email',
    //'formsubmit',
          //  'password',
            // 'auth_key',
            // 'create_Date',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php endif; ?>


</div>
-->