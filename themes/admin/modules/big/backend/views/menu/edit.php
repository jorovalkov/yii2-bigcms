<?php
/**
 * @link http://www.bigbrush-agency.com/
 * @copyright Copyright (c) 2015 Big Brush Agency ApS
 * @license http://www.bigbrush-agency.com/license/
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use bigbrush\big\widgets\bigsearch\BigSearch;

$this->registerJs('$("#btn-select-content").click(function(e){
    e.preventDefault();
});');
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-12">
        <?php Yii::$app->toolbar->save()->back(); ?>
        <h1>Edit menu item</h1>
    </div>
</div>


<div class="row">
    <div class="col-md-9">
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'route', [
            'template' => '
                {label}
                <div class="form-group">
                    {error}
                    <div class="input-group">
                        {input}
                        <span class="input-group-btn">
                            <button id="btn-select-content" class="btn btn-info btn-block" data-toggle="modal" data-target="#content-modal">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
                '
        ]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'menu_id')->dropDownList($menus) ?>
            </div>
            <div class="col-md-6">
                <?php if ($model->menu_id) : ?>
                <?= $form->field($model, 'parent_id')->dropDownList($parents) ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'state')->dropDownList($model->getStateOptions()) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'is_default')->dropDownList($model->getIsDefaultOptions()) ?>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <h3>Menu SEO</h3>
        <?= $form->field($model, 'meta_title') ?>
        <?= $form->field($model, 'meta_description')->textArea() ?>
        <?= $form->field($model, 'alias') ?>
        <?= $form->field($model, 'meta_keywords') ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php
Modal::begin([
    'header' => '<h4>Select content</h4>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
    'id' => 'content-modal',
    'size' => Modal::SIZE_LARGE,
]); ?>

<?= BigSearch::widget([
    'linkClickCallback' => 'function(e){
        e.preventDefault();
        var route = $(this).data("route");
        $("#content-modal").on("hidden.bs.modal", function(){
            $("#menu-route").val(route);
        }).modal("hide");
    }',
]); ?>

<?php Modal::end(); ?>