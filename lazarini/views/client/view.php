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

$addressSearch = new \app\models\AddressSearch();
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
        <?= Html::a('Create Address', \yii::$app->urlManager->createUrl(['/address/create', 'clientId' => $model->id]), ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'phone',
            'reference',
            'address' => [
                'label' => 'Addresses',
                'value'  => GridView::widget([
                    'dataProvider' => $addressSearch->search(['AddressSearch' => ['clientId' => $model->id]]),
                    'layout' => '{items}',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'location',
                        'custom' => [
                            'header' => '',
                            'format' => 'html',
                            'value' => function($data) use ($model) {
                                return Html::a("Create Order", \yii::$app->urlManager->createUrl(['order/create', 'clientId' => $model->id, 'address' => $data->location]), ['class' => 'btn btn-block btn-success']);
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'controller' => 'address'
                        ]
                    ],
                ]),
                'format' => 'html'
            ]
        ],
    ]) ?>
    <hr>



    <hr>
    <h3>Order History</h3>

    <?= GridView::widget([
        'dataProvider' => (new \app\models\OrderSearch())->search(['OrderSearch' => ['clientId' => $model->id]]),
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
