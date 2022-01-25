<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BranchesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row ">
        <div class="input-group input-group-sm">
                <?= $form->field($model, 'globalSearch')->textInput(['placeholder' =>'Search...','aria-label'=>'Search','type'=>'search','class'=>'form-control form-control-navbar'])->label(false) ?>
                <div class="input-group-addon">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-navbar bg-danger']) ?>                  
                </div>
        </div>
        <!-- <div class="col-lg-3">
            <div class="float-right">
                <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
