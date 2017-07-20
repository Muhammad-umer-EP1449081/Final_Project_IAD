<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\relationship;

/* @var $this yii\web\View */
/* @var $model app\models\Reply */

$this->title = $model->cm_id;
$this->params['breadcrumbs'][] = ['label' => 'Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cm_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cm_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cm_id',
            'message:ntext',
            'user_id_message',
            'time',
            'status',
            'conversation_id',
        ],
    ]) ?>

</div>
