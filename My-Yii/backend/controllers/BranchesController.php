<?php

namespace backend\controllers;
use Yii;
use backend\models\Branches;
use backend\models\BranchesSearch;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
// use yii\web\ForbiddenHttpException;

use yii2tech\csvgrid\CsvGrid;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
     * @param int $branch_id Branch ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionExport()
    {

        $exporter = new CsvGrid([
            'dataProvider' => new ActiveDataProvider([
                'query' => Branches::find(),
            ]),
            'columns' => [
                [
                    'attribute' => 'branch_name',
                    'label' => 'Name'
                ],
                [
                    'attribute' => 'branch_address',
                    'label' => 'Address',
                ],
            ],
        ]);
        return $exporter->export()->send('branches.csv');
    }

    /**
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Branches();

        if(Yii::$app->request->isAjax){
            if($this->request->post('action') == 'createBranch'){
                // Getting post data from ajax form
                $company_id = $this->request->post('company_id');
                $branch_name = $this->request->post('branch_name');
                $branch_address = $this->request->post('branch_address');
                $branch_status = $this->request->post('branch_status');

                // Setting data insert into table/model branch 
                $model->companies_company_id = $company_id;
                $model->branch_name = $branch_name;
                $model->branch_address = $branch_address;
                $model->branch_status = $branch_status;
                if($model->save()){
                    $branchModel = Branches::find()->where(['branch_id'=>$model->branch_id])->asArray()->one();
                    return json_encode($branchModel);
                }else{
                    return json_encode($model->getErrors());
                }
                
                
            }
        }
        if(\Yii::$app->user->can('create_branch')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->save();
                }
            } else {
                $model->loadDefaultValues();
            }
    
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionImportExcel(){
        
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $branch_id Branch ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'branch_id' => $model->branch_id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $branch_id Branch ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $branch_id Branch ID
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($branch_id)
    {
        if (($model = Branches::findOne($branch_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
