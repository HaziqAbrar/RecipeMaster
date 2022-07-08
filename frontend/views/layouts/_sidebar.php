<?php

use yii\bootstrap4\Nav;

?>

<div class="sidebar shadow" style="min-width:200px">
<?php echo Nav::widget([
    'options' => [
        'class' => 'd-flex flex-column nav-pills'
    ],
    'items' => [
        [
            'label' => 'Kitchen Island',
            'url' => ['/recipe/index']
        ],
        [
            'label' => 'Cooked Recipe',
            'url' => ['/recipe/history']
        ]
    ]
]) ?>
</div>
