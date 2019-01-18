<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MealsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= (Yii::$app->user->identity->is_admin == 1) ? Html::a('Create Meals', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {

            return ['id' => $model['id'], 'onclick' => 'window.location.href = \'index.php?r=meals/view&id=\' + this.id;'];

        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'start_date',
            'end_date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Open' : 'Closed';
                },
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                    'visible' => (Yii::$app->user->identity->is_admin == 1)
            ],
        ],
    ]); ?>
</div>
