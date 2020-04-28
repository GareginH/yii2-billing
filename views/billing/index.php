<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BillingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Billings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Billing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            'id',
            'amount',
            'user_id',
            'user.username',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
