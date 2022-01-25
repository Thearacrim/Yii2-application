<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompaniesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'globalSearch')->textInput(['placeholder' =>'Global Search...'])->label(false) ?>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="float-right">
                <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

  

    <?php // echo $form->field($model, 'company_status') ?>

   
    <?php ActiveForm::end(); ?>

</div>
