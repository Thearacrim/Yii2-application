<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">


    <?php echo $this->render('_search', ['model'=>$searchModel])?>


    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        // 'filterModel' => $searchModel,
        'tableOptions' => [ 
            'class' => 'table table-bordered bg-light table-md'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'company_id',
            'company_name', 
            'company_email:email',
            'company_address',
            'company_created_date',
            //'company_status',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'Action',
            
            ],
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
