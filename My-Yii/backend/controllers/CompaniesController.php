<?php

namespace backend\controllers;

use backend\models\Companies;
use backend\models\Branches;
use backend\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
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
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companies model.
     * @param int $company_id Company ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Companies();
        $modelbranch = new Branches();


        if(\Yii::$app->user->can('create_company')){
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $modelbranch->load($this->request->post())) {
                    $imagename = $model->company_name;
                    if(!empty($model->file)){
                        $model->file = UploadedFile::getinstance($model,'file'); 
                        $model->file->saveAs('Uploads/'.$imagename.'.'.$model->file->extension);
                        //save file uploaded to db
                        $model->logo = 'Uploads/'.$imagename.'.'.$model->file->extension; 
                    }
                    
                    $model->company_created_date = date('Y-m-d H:i:s');
                    $model->save();

                    $modelbranch->companies_company_id = $model->company_id;
                    $modelbranch->save();
                    return $this->redirect(['view', 'id' => $model->company_id]);
                }
            } else {
                $model->loadDefaultValues();
            }
        }else{
            throw new ForbiddenHttpException;
        }

        return $this->render('create', [
            'model' => $model,
            'modelbranch' => $modelbranch,
        ]);
    }

    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $company_id Company ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelbranch = Branches::findOne(['companies_company_id'=>$model->company_id]);
        if(!$modelbranch){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if ($model->load($this->request->post()) && $modelbranch->load($this->request->post())) {
            if($model->save() && $modelbranch->save()){
                $modelbranch->save();
            
                return $this->redirect(['view', 'id' => $model->company_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelbranch'=> $modelbranch,
        ]);
    }

    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $company_id Company ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $company_id Company ID
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
