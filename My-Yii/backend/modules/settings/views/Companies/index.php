<?php

use yii\helpers\Html;
use yii\grid\GridView;
// use dosamigos\datepicker\DatePicker;
use yii\widgets\Pjax;
use backend\assets\DataPicker;
Datapicker::register($this);


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Companies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 

        //check if datapicker_start_date have been set
        $datepicker_start_date = '';
        //Name modelsearch
        if(Yii::$app->request->get('CompaniesSearch')){
            //name db field
            $datepicker_start_date = Yii::$app->request->get('CompaniesSearch')['company_start_date'];
        }
        
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'company_id',
            'company_name',
            'company_email:email',
            'company_address',
            'company_created_date',
            [
                'attribute' =>'Company_start_date', 
                'value' => function($model){
                    //format date according to specified date
                    return date_format(date_create($model->company_start_date),'d M, Y');
                },
                'filter' => '<input type="text" readonly value="'.$datepicker_start_date.'" class="datepicker form-control" name="CompaniesSearch[company_start_date]"/>',
                'format' =>'html',
            ],

            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Action'
        ],         
        ],
    ]); ?>
        <?php Pjax::end(); ?>

</div>

<?php
$script = <<< JS
    $(".datepicker").keydown(function(){
        return false;
    });
    $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
    $(document).on('ready pjax:success', function(){ 
        $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
     });
JS;
$this->registerJs($script); ?>

</div>