<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Recipe */

$this->title = 'Update Recipe: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'recipe_id' => $model->recipe_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recipe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
