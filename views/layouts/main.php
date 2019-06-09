<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

\yii\web\YiiAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="<?= Yii::$app->request->getBaseUrl() ?>/css/site.css"/>
    <?php $this->head() ?>
    <style>
        .header img {
            height: 50px;
            text-align: center;
        }

        .header div {
            text-align: center;
        }

        .header h1 {
            padding: 0 10px 0 10px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header">
    <h1><?= Html::a('Экозов', ['/']) ?></h1>
    <div><img src="<?= Url::base() . '/images/icons/alarm_for_user.svg' ?>" alt="alarm_for_user">
        <img src="<?= Url::base() . '/images/icons/megaphone_for_business.svg' ?>" alt="megaphone_for_business"></div>
</div>

<div class="content">
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
