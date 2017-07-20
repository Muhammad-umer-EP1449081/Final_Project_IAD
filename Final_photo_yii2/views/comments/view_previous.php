<!--
<?php
/* @var $this yii\web\View */
/* @var $model app\models\Comments */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'photograph_id',
            'created',
            'author',
            'body:ntext',
        ],
    ]) ?>

</div>
-->

<!--<?php
echo $comments[0]->photograph_id;
?>
<?php foreach ($comments as $comment) :?> 

<p><?php echo $comment->body?></p>
<br>
     
<?php endforeach; ?>-->