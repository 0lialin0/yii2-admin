<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = '添加用户';
$this->params['breadcrumbs'][] = $this->title;

$dataMap = Yii::$app->params['dataMap'];

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>


    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-add']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'nickname') ?>
            <?= $form->field($model, 'gender')->dropDownList($dataMap['genderList']) ?>
            <?= $form->field($model, 'user_level')->dropDownList($dataMap['userLevelList']) ?>
            <label class="control-label" for="area-code">所属区域</label>
            <?= Html::activeHiddenInput($model, 'area_code') ?>
            <?=

             AutoComplete::widget([
                'name' => 'area-code-name',
                'id' => 'area-code-name',
                'value' => '',
                'clientOptions' => [
                    'source' => new JsExpression("function(request, response) {
                                    $.getJSON('".\yii\helpers\Url::to('auto-complete')."', {
                                        term: request.term,
                                        type: $('#user-user_level').val()
                                    }, response);
                                }"),
                    'autoFill' => true,
                    'minLength' => '1',
                    'select' => new JsExpression("function( event, ui ) {
                            $('#user-area_code').val(ui.item.id);
                        }")
                 ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => '请输入所属区域，下拉选择',
                ]
            ]);
            ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('添加用户', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
