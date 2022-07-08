<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\Application;
use \backend\assets\TagsInputAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Recipe */
/* @var $form yii\bootstrap4\ActiveForm */

\backend\assets\TagsInputAsset::register($this);
?>

<div class="recipe-form" >

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-8">

            <?php echo $form->errorSummary($model) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        
            <?= $form->field($model, 'tags', ['inputOptions' => ['data-role' => 'tagsinput']
            ])->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'average_cost')->textInput() ?>
        
        </div>
        <div class="col-sm-4 mt-3 mt-3">
                <img class="position:sticky; text-align: center; ml-5 mb-5" src="<?php echo $model->getThumbnailLink()?>" alt="">
            
            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
