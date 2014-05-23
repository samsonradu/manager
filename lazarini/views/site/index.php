<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'Administration Panel';
?>
<div class="site-index">

    <div class="body-content">
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
