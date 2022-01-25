<?php

namespace frontend\models; 

use yii\base\Model;
class UserForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }
}