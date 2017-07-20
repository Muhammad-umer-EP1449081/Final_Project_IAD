<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Replies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reply', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cm_id',
            'message:ntext',
            'user_id_message',
            'time',
            'status',
            // 'conversation_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
