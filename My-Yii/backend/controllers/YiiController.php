<?php

namespace backend\controllers;
use yii\web\Controller;

/**
 * Site controller  
 */
class YiiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function actionHello(){
        return $this->render('index');
    }
}
