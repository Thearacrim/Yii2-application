<?php

namespace frontend\controllers;

use Yii;

use yii\web\Controller;
use frontend\models\UserForm;   


/**
 * Site controller
 */
class YiiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function actionHello(){
        return $this->render('');
    }

    public function actionUser(){
        $model = new UserForm;
        if($model->load(Yii::$app->request->post())&& $model->validate()){
                        //set flash data
            Yii::$app->session->setFlash('success','Your account has been entered');
        }
        return $this->render('hello',['model'=>$model]);
    }
    public function actionIndex(){
        echo "Hi";
    }
}
?>
