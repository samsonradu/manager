<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\OrderSearch $searchModel
 */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'client.name'=> [
                'header' => 'Client',
                'value' => function($data) {
                    return Html::a($data->client->name, \yii::$app->urlManager->createUrl(['client/view', 'id' => $data->clientId]));
                },
                'format' => 'html'
            ],
            'status',
            'description',
            'driver.name' => [
                'header' => 'Driver',
                'value' => 'driver.name'
            ],
             'createdAt',
            // 'updatedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
