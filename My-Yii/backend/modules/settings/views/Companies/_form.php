<?php

// use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use backend\assets\DataPicker;
Datapicker::register($this);
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'company_start_date')->textInput(['id'=>'datepicker', 'readonly'=>true])?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
  $script = <<< JS
      $("#datepicker").keydown(function(){
        return false;
      });
      $(function () {
    $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
  });
  JS;
  $this->registerJs($script); ?>

</div>
