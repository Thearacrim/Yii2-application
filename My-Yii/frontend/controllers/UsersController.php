<?php

namespace frontend\controllers;
//include use model to access throw table user
use frontend\models\Users;

use yii\web\Controller; 


/**
 * Site controller
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function actionIndex(){
        $users = Users::find()->all();
        // print_r($users);
        return $this->render('index',['users' => $users]);
    }
}
?>

