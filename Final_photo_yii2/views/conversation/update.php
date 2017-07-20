<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\conversation */

$this->title = 'Update Conversation: ' . $model->conversation_id;
$this->params['breadcrumbs'][] = ['label' => 'Conversations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->conversation_id, 'url' => ['view', 'id' => $model->conversation_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conversation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
