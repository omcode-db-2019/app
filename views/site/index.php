<?php
/* @var $this yii\web\View */
$this->title = 'Экозов';

use phpnt\yandexMap\YandexMaps; ?>

<?= YandexMaps::widget([
    'myPlacemarks' => $items,
    'mapOptions' => [
        'center' => [55.7532236, 37.6004214],                                                // центр карты
        'zoom' => 11,                                                       // показывать в масштабе
        'controls' => ['zoomControl', 'fullscreenControl'],  // использовать эл. управления
        'control' => [
            'zoomControl' => [                                                        // расположение кнопок управлением масштабом
                'top' => 75,
                'left' => 5
            ],
        ],
    ],
    'disableScroll' => false,                                                    // отключить скролл колесиком мыши (по умолчанию true)
    'windowWidth' => '100%',                                                  // длинна карты (по умолчанию 100%)
    'windowHeight' => '100vh',                                                 // высота карты (по умолчанию 400px)
]); ?>