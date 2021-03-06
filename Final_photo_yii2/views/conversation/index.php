<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\conversationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conversations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conversation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Conversation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'conversation_id',
            'user_one_id',
            'user_two_id',
            'first_msg_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
