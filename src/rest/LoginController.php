<?php

namespace cuborojo\yii2\auth\rest;

use yii\rest\ActiveController;

class LoginController extends ActiveController
{
    public $modelClass = "cuborojo\yii2\auth\models\User";

    public function actions()
    {
        return [
            'signin' => [
                'class' => 'cuborojo\yii2\auth\rest\SigninAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
        ];
    }

    protected function verbs()
    {
        return [
            'signin' => ['POST'],
        ];
    }
}
