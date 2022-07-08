<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Recipe */

$this->title = 'Create Recipe';
$this->params['breadcrumbs'][] = ['label' => 'Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <?= $this->render('_form', [
                'model' => $model,
            ]) ?> -->

    <?php \yii\bootstrap4\ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]) ?>

    <button type='button' class="btn btn-primary btn-file">
        Select Thumbnail
        <input type="file" id="recipeTN" name="recipe">
    </button>
    <a class="btn btn-success" href="javascript:void(0)">Click me</a>

    <?php \yii\bootstrap4\ActiveForm::end() ?>

</div>