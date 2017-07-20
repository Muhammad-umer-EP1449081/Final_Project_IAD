<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Photography */

$this->title = 'Create Photography';
$this->params['breadcrumbs'][] = ['label' => 'Photographies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photography-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
