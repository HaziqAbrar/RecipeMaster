<?php

/** @var $model \common\models\Recipe */

use yii\helpers\Url;

?>


<div class="card m-3" style="width:18rem">
    <a href="<?php echo Url::to(['/recipe/view', 'id' => $model->recipe_id]) ?>">
        <div>
            <img class="card-img-top" src="<?php echo $model->getThumbnailLink() ?>" alt="Card image">
        </div>

    </a>
    <div class="card-body">
        <h4 class="card-title"><?php echo $model->name ?></h4>
        <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
    </div>
</div>