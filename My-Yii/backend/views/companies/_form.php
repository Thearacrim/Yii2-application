<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Companies;

/* @var $this yii\web\View */
/* @var $model backend\models\Companies */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file' )->fileInput() ?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>


    <!-- Create Branch -->

    <?php echo $form->field($modelbranch, 'branch_name')->textInput(['maxlength' => true])?>

    <?php echo $form->field($modelbranch, 'branch_address')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($modelbranch, 'branch_status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <?php echo $form->field($modelbranch, 'branch_status')->radioList([
    1 => 'radio 1', 
    2 => 'radio 2'
]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
