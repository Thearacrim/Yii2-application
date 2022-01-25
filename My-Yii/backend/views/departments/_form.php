<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Companies;

use backend\models\Branches;

use backend\assets\Select2;
Select2::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); 
    $dataCompany = ArrayHelper::map(Companies::find()->all(),'company_id','company_name');
    $dataBranches = ArrayHelper::map(Companies::find()->all(),'branch_id','branch_name');
    ?>

    <?= 
        $form->field($model, 'companies_company_id')->dropDownList(
        $dataCompany, 
        ['prompt' => 'select oun 1','class'=>'form-control isSelect2']
    );
    ?>

    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    <?= 
        $form->field($model, 'branches_branch_id')->dropDownList(
        $dataBranches, 
        ['prompt' => 'select oun 1','class'=>'form-control isSelect2']
    );
    ?>

    <?= $form->field($model, 'department_status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$base_url = Yii::getAlias('@web');
$script = <<< JS
    var base_url = "base_url";
   
    $(document).ready(function() {
        $('.isSelect2').select2({
            placeholder: "Select a state",
        });
        $("#departments-companies_company_id").change(function(){
            var id = $(this).val();
            $.ajax({
                url: "http://localhost/my-yii/backend/web/index.php?r=departments%2Fcreate",
                type: 'post',
                data: {
                    companyid: id,
                    action: "getBranchByCompany",
                },
                success: function(response){
                    var date = JSON.parse(response);
                    var str = '<option></option>';
                    $.each(date, function(key,value) {
                        str += "<option value='"+ value.branch_id+"'>"+value.branch_name+"</option>";
                    });
                    $("#departments-branches_branch_id").html(str);
                },
                error: function(err){
                    console.log(err);
                }
            });
        });
    });
   
    JS;
$this->registerJs($script); ?>

