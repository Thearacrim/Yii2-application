<?php

use yii\helpers\Html;
use yii2tech\csvgrid\CsvGrid;
use backend\models\Branches;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use backend\assets\Select2;
Select2::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <button type="button" value="<?= Url::to(['branches/create'])?>" class="btn btn-primary trigggerModal float-right mb-3">Create Branches</button>
    <?php //Html::script('alert("Hello!");') ?>
    <?php //Html::style('.text { color: red; }') ?>
    <!-- <h2 class="text">Hello</h2> -->
    <?php 
    Modal::begin([
        'title'=>'Add New Branches',
        'id'=>'modal',
        'size'=>'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>
    
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,  
        'tableOptions' => [ 
            'class' => 'table table-bordered bg-light'
        ],
        'rowOptions' => function ($model){
            if($model->branch_status == 'Inactive'){
              return ['class' => 'bg-maroon color-palette'];
            }else if ($model->branch_status == 'Active'){
                return ['class' => 'bg-light '];
            }
      },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'companies_company_id',
                'value' => 'companiesCompany.company_name',      
            ],
            'branch_name',
            'branch_address',
            'branch_status',

            ['class' => 'yii\grid\ActionColumn',
            'header'=> 'Action'
            ],
        ],  
    ]); 
    ?>
    <?php Pjax::end(); ?>

</div>
<?php

$script = <<< JS
    $(document).on("click",".trigggerModal",function(){
        $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
    })
JS;
$this->registerJs($script); 

?>
