<?php
use yii\bootstrap5\Nav;
?>

<aside class="shadow">
  <?php 
  echo Nav::widget([
    'options' => [
      'class' => 'd-flex flex-column nav-pills'
    ],
    'encodeLabels' => false,
    'items' => [
      [
        'label' => '<i class="fas fa-home"></i> Home',
        'url' => ['site/index']
      ],
      [
        'label' => 'Videos',
        'url' => ['video/index']
      ],
    ]
  ]);
  ?>
</aside>