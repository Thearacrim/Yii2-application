<?php

use yii\helpers\Html;
use backend\models\Companies;
use yii\helpers\arrayhelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>
 
<div class="branches-form">
    
    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); 
            $dataBranches = ArrayHelper::map(Companies::find()->all(),'company_id','company_name');
    ?>
    <?= 
        $form->field($model, 'companies_company_id')->dropDownList(
        $dataBranches, 
        ['prompt' => 'select oun','class'=>'form-control isSelect2']
    );
    ?>   
    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'submitForm']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php
$base_url = Yii::getAlias("@web");
$script = <<< JS
    var base_url = "$base_url";
    $('.isSelect2').select2({
        placeholder: "Select a state",
        width: "100%",
    });

    $(document).on('click', "#submitForm", function(e){
        e.preventDefault();
        var company_id = $("#branches-companies_company_id").val();
        var branch_name = $("#branches-branch_name").val();
        var branch_address = $("#branches-branch_address").val();
        var branch_status = $("#branches-branch_status").val();

        $.ajax({
            url: "http://localhost/my-yii/backend/web/index.php?r=branches/create",
            method: 'post',
            data: {
                company_id:company_id,
                branch_name:branch_name,
                branch_address:branch_address,
                branch_status:branch_status,
                action: 'createBranch'
            },
            success: function(response){
                var data = JSON.parse(response);
                console.log(data);
                var string = `<tr class="bg-info" data-key="\${data.branch_id}">
                                <td>16</td>
                                <td>King</td>
                                <td>\${data.branch_name}</td>
                                <td>\${data.branch_address}</td>
                                <td>Active</td>
                                <td>
                                    <a href="/branches/view?id=27" title="View" aria-label="View" data-pjax="0">
                                    <svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path>
                                    </svg>
                                    </a>
                                    <a href="/branches/update?id=27" title="Update" aria-label="Update" data-pjax="0">
                                    <svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path>
                                    </svg>
                                    </a>
                                    <a href="/branches/delete?id=27" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post">
                                    <svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path>
                                    </svg>
                                    </a>
                                </td>
                                </tr>`;
                $(".table_branch_data tbody").append(string);
                $("#branches-companies_company_id").val('');
                $("#branches-branch_name").val('');
                $("#branches-branch_address").val('');
                $("#branches-branch_status").val('');
            },
            error: function(err){
                console.log(err);
            },
        }) 
    });

JS;
$this->registerJs($script); ?>

    

</div>
