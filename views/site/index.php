<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

use phpnt\yandexMap\YandexMaps; ?>

<?= YandexMaps::widget([
    'myPlacemarks'          => $items,
    'mapOptions'            => [
        'center'            => [52, 59],                                                // центр карты
        'zoom'              => 3,                                                       // показывать в масштабе
        'controls'          => ['zoomControl',  'fullscreenControl'],  // использовать эл. управления
        'control'           => [
            'zoomControl'   => [                                                        // расположение кнопок управлением масштабом
                'top'       => 75,
                'left'      => 5
            ],
        ],
    ],
    'disableScroll'         => true,                                                    // отключить скролл колесиком мыши (по умолчанию true)
    'windowWidth'           => '100%',                                                  // длинна карты (по умолчанию 100%)
    'windowHeight'          => '400px',                                                 // высота карты (по умолчанию 400px)
]);?>