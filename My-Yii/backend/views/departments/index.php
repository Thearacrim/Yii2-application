<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <p>
        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [ 
            'class' => 'table table-bordered bg-light table-sm'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'companiesCompany.company_name',
            'branchesBranch.branch_name',
            'department_id',
            'department_name',
            'department_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
