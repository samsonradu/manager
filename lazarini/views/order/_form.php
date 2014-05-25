<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Order $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clientId')->dropDownList(\app\models\Client::getListOptions())?>

    <?= $form->field($model, 'address')->textInput()?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 2000]) ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => 45]) ?>

    <hr>

    <?= $form->field($model, 'driverId')->dropDownList(\app\models\Driver::getListOptions()) ?>

    <?= $form->field($model, 'eta')->textInput(['maxlength' => 5]) ?>

    </hr>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Order::getListOptions()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
