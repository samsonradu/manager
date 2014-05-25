<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'Administration Panel';


use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="site-index">

    <div class="body-content">
        <div class="row highlight">
            <div class="col-md-4 col-md-offset-4" align="center">
                <h3>New Order</h3>
                <div>
                    <?php
                    $model = new \app\models\ClientSearch();
                    $form = ActiveForm::begin(['action' =>  \yii::$app->urlManager->createUrl(['/client/index']), 'method' => 'GET']); ?>
                    <?= $form->field($model, 'phone', ['template' => '{input}'])->textInput(['placeholder' => 'Phone number ...', 'maxlength' => 45]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' =>'btn btn-block btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-6">
                <?php  echo $this->render('//order/dashboard'); ?>
            </div>
            <div class="col-md-6">
                <h3>Totals</h3>
                <div class="alert alert-info">
                    <p>
                        Today you completed orders up to <?=\app\models\Order::getTotal(\app\models\Order::STATUS_DELIVERED, date('Y-m-d'), date('Y-m-d', time()+86400));?> RON
                    </p>
                    <p>
                        This month you completed orders up to <?=\app\models\Order::getTotal(\app\models\Order::STATUS_DELIVERED, date('Y-m-01'), date('Y-m-d', time()+86400));?> RON
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
