<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Cocineros Unidos',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
//        ['label' => 'Acerca de', 'url' => ['/site/about']],
//        ['label' => 'Contacto', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        //agregado el boton de registrarse, cuando no existe un usuario logueado
        $menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/register']];
        $menuItems[] = ['label' => 'Iniciar Sesión', 'url' => ['/site/login']];
    }
    else {
        $menuItems[] = ['label' => 'Editar Mis Datos', 
                        'url' => ['/site/editself', 'id' => Yii::$app->user->identity->id]];
        $menuItems[] = [
            'label' => 'Cerrar Sesión (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    ?>
    <div class="navbar-text pull-right">
        <?=
        \lajax\languagepicker\widgets\LanguagePicker::widget([
            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_LARGE
        ]);
        ?>
    </div>
    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Cocineros Unidos <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
