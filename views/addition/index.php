<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdditionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Additions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Additions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'description',
            'additionType.description',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
