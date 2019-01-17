<?php

use app\models\Additions;
use app\models\Orders;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Meals */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meals-view">

    <h1>Meal of <?= Yii::$app->formatter->format($model->start_date, 'relativeTime') ?></h1>

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
            'start_date',
            'end_date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Open' : 'Closed';
                },
            ],
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user.username',
            [
                'attribute' => 'additions',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getAdditionsAsString();
                },
            ],
            [
                'attribute'=>   'actions',
                'label'=>'Actions',
                'format' => 'raw',
                'value' => function($data){
                    $add_url = Yii::$app->urlManager->createUrl('order/view')."&id=".$data->id."&user_id=".$data->user_id."&meal_id=".$data->meal_id;
                    $del_url = Yii::$app->urlManager->createUrl('order/delete')."&id=".$data->id."&user_id=".$data->user_id."&meal_id=".$data->meal_id;
                    return '<a class="btn btn-primary" href="'.$add_url.'" title="Edit">Edit</a>
                            <a class="btn btn-danger" href="'.$del_url.'" data-confirm="Are you sure you want to delete this item?" data-method="post">Delete</a>';
                }

            ],
        ],
    ]); ?>

</div>
