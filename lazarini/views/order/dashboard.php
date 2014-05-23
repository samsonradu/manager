<?php
/**
 *
 */

$result = \app\models\Order::find()->where(
    [
        'status' => \app\models\Order::STATUS_PENDING
    ]
)->count();
?>
<h2>Orders</h2>
<div class="alert alert-danger">
    <p>There are <?=$result?> pending orders. <?=\yii\helpers\Html::a("view",
            \Yii::$app->urlManager->createUrl(['order/index', 'OrderSearch[status]' => \app\models\Order::STATUS_PENDING]))?>
    </p>
</div>