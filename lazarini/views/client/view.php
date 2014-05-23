<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\Client $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

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
            'name',
            'phone',
            'reference',
        ],
    ]) ?>
    <hr>
    <h3>Addresses</h3>
    <p>
        <?= Html::a('Create Address', \yii::$app->urlManager->createUrl(['/address/create', 'clientId' => $model->id]), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => (new \app\models\AddressSearch())->search(['clientId' => $model->id]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'location',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'address'
            ]
        ],
    ]); ?>

    <hr>
    <h3>Orders</h3>
    <p>
        <?= Html::a('Create Order', ['/order/create', 'clientId' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => (new \app\models\OrderSearch())->search(['clientId' => $model->id]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'description',
            'createdAt',
            'total',
            'driver.name' => [
                'header' => 'Driver',
                'value' => function($data) {
                    return $data->driver->name;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'order'
            ],
        ],
    ]); ?>

</div>
