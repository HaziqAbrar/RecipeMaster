<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

?>

<div class="sidebar shadow" style="min-width:200px">
<?php echo \yii\bootstrap4\Nav::widget([
    'options' => [
        'class' => 'd-flex flex-column nav-pills'
    ],
    'items' => [
        [
            'label' => 'Kitchen Island',
            'url' => ['/site/index']
        ],
        [
            'label' => 'Your Kitchen Counter',
            'url' => ['/recipe/index']
        ]
    ]
]) ?>
</div>
