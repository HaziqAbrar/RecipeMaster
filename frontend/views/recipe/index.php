<?php

/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\widgets\ListView;

?>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_recipe_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false
    ]
])

?>