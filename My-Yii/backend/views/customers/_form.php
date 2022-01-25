<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\arrayhelper;
use backend\models\locations;
use backend\assets\Select2;
Select2::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); 
        $datalocation = ArrayHelper::map(locations::find()->all(),'location_id','zip_code');
    ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= 
        $form->field($model, 'zip_code')->dropDownList(
        $datalocation, 
        ['prompt' => 'select oun','class'=>'form-control isSelect2']
    );
    ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $script = <<< JS
        var base_url = "base_url";
        $(document).ready(function() {
            $('.isSelect2').select2({
                placeholder: "Select a state",
            });
            $("#customers-zip_code").change(function(){
                var id = $(this).val();
                $.ajax({
                    url: "http://localhost/my-yii/backend/web/index.php?r=customers%2Fcreate",
                    type: 'post',
                    data: {
                        customerid: id,
                        action: "getlocationBycustomer",
                    },
                    success: function(response){
                        var data = JSON.parse(response);
                        
                            $('#customers-city').val(data[0]['city']);
                            $('#customers-province').val(data[0]['province']);
                        
                        
                        console.log(data);
                    },
                    error: function(err){
                        console.log(err);
                    }
                });
            });
        });
   
    JS;
$this->registerJs($script); ?>

</div>
