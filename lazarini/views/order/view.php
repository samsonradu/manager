<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Order $model
 */

$this->title = $model->client->name." - ".$model->description;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

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
            'clientId' => [
                'label' => 'Client',
                'value' =>  Html::a($model->client->name, \yii::$app->urlManager->createUrl(['client/view', 'id' => $model->clientId])),
                'format' => 'html'
            ],
            'address',
            'status',
            'description',
            'driver' => [
                'label' => 'Driver',
                'value' => $model->driver->name
            ],
            'total',
            'createdAt'
        ],
    ]) ?>

</div>
