<?php

use app\models\MessageForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
            cursor: pointer;
        }

        .header div {
            text-align: center;
        }

        .header h1 {
            padding: 0 10px 0 10px;
            color: #fff;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header">
    <h1>ЭКОЗОВ</h1>
    <div>
        <img class="openModal1" src="<?= Url::base() . '/images/icons/alarm_for_user.svg' ?>" alt="alarm_for_user">
        <img class="openModal2" src="<?= Url::base() . '/images/icons/megaphone_for_business.svg' ?>"
             alt="megaphone_for_business"></div>
</div>

<div class="content">
    <?= $content ?>
</div>
<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => '<h3>Сообщить о проблеме</h3>',
    'id' => 'modal1',
    'size' => 'modal-md',
    'closeButton' => [
        'id' => 'close-button',
        'class' => 'close',
        'data-dismiss' => 'modal',
    ]
]);

$form = ActiveForm::begin([
    'id' => 'login-form1',
    'options' => ['class' => 'form-horizontal', 'style' => "margin: 20px"],
]) ?>
<?= $form->field(new MessageForm(), 'message')->textarea(['rows' => '6'])->label('') ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>



<?php yii\bootstrap\Modal::end();
?>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader-2'],
    'header' => '<h3>Отправить экостатус</h3>',
    'id' => 'modal2',
    'size' => 'modal-md',
    'closeButton' => [
        'id' => 'close-button',
        'class' => 'close',
        'data-dismiss' => 'modal',
    ]
]);

$form = ActiveForm::begin([
    'id' => 'login-form2',
    'options' => ['class' => 'form-horizontal', 'style' => "margin: 20px"],
]) ?>
<?= $form->field(new MessageForm(), 'message')->textarea(['rows' => '6'])->label('') ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>



<?php yii\bootstrap\Modal::end();
?>

<?php $this->endBody() ?>
<?php
$script = <<< JS
    $(function() {
        $('.openModal1').click(function () {
            $('#modal1').modal('show')
        });
    });
$(function() {
        $('.openModal2').click(function () {
            $('#modal2').modal('show')
        });
    });
JS;

$this->registerJs($script);
?>
</body>
</html>
<?php $this->endPage() ?>
