<?php
/**
 * @link http://www.bigbrush-agency.com/
 * @copyright Copyright (c) 2015 Big Brush Agency ApS
 * @license http://www.bigbrush-agency.com/license/
 */

use yii\helpers\Html;
use yii\helpers\Url;
use cms\components\Toolbar;
use cms\widgets\AdminMenu;
use cms\widgets\Alert;
use app\themes\admin\assets\ThemeAsset;

ThemeAsset::register($this);

$this->registerJs('
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        elm = $("#toggler-icon");
        if(elm.hasClass("glyphicon-arrow-left")) {
            $.get("'.Url::to(['/app/frontpage/remember-show-sidebar', 'show' => false]).'");
            elm.removeClass("glyphicon-arrow-left").addClass("glyphicon-arrow-right");
        } else {
            $.get("'.Url::to(['/app/frontpage/remember-show-sidebar', 'show' => true]).'");
            elm.removeClass("glyphicon-arrow-right").addClass("glyphicon-arrow-left");
        }
    });
');

$showSidebar = Yii::$app->getSession()->get('__app_show_sidebar__', true);
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
    <?php if ($showSidebar) : ?>
    <div id="wrapper">
    <?php else : ?>
    <div id="wrapper" class="toggled">
    <?php endif; ?>

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?= AdminMenu::widget(); ?>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div id="sidebar-toggler">
                <?php if ($showSidebar) : ?>
                <button id="menu-toggle" type="button" class="btn btn-default btn-xs"><span id="toggler-icon" class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
                <?php else : ?>
                <button id="menu-toggle" type="button" class="btn btn-default btn-xs"><span id="toggler-icon" class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                <?php endif; ?>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?= Yii::$app->toolbar->render() ?>
                    </div>
                </div>
                
                <div class="content-wrapper">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
                
                <!-- Footer -->
                <footer id="footer-wrapper" class="text-center">
                    <p>BIG CMS © <?= date('Y') ?></p>
                </footer>
                <!-- /#footer-wrapper -->
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>