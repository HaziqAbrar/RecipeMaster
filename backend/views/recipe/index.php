<?php

use common\models\Recipe;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Recipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-index">


    <!-- <div class="mt-5 d-block mx-auto"> -->
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Recipe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <!-- </div> -->

    <div class="d-flex justify-content-center">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'image',
                    'label' => 'Image',
                    'format' => 'raw',

                    'value' => function ($model) {
                        $url = \Yii::$app->params['frontendUrl'] . 'storage/thumbnail/' . $model->recipe_id . '.jpg';
                        return Html::img($url, ['alt' => 'myImage', 'width' => '200']);
                    }
                ],

                // 'recipe_id',
                'name',
                // 'description:ntext',
                'tags',
                'average_cost',

                //this is associative array
                [
                    'attribute' => 'status',
                    'content' => function ($model) {
                        return $model->getStatusLabels()[$model->status];
                    }
                ],
                'created_at:datetime',
                //'updated_at',
                //'created_by',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Recipe $model) {
                        return Url::toRoute([$action, 'recipe_id' => $model->recipe_id]);
                    }
                ],
            ],
        ]); ?>

    </div>


</div>