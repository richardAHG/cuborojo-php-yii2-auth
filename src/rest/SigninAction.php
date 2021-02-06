<?php

namespace cuborojo\yii2\auth\rest;

use Yii;
use yii\rest\Action;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use Firebase\JWT\JWT;

class SigninAction extends Action
{
    public function run()
    {
        $params = Yii::$app->getRequest->getBodyParams();

        if (!isset($params["username"]) || !isset($params["username"])) {
            throw new BadRequestHttpException("Parámetros incorrectos");
        }

        if (!$user = $this->modelClass->validateUsername($params["username"])) {
            throw new ForbiddenHttpException("Usuario o Contraseña incorrectos");
        }

        if (!password_verify($params["password"], $user->password)) {
            throw new ForbiddenHttpException("Usuario o Contraseña incorrectos");
        }

        $key = "nolberto";
        $payload = [
            "atk" => "asdfashdfkjasdfjasdbfkasdfbkasdasdf",
            "nm" => "Nolberto Vilchez",
            "ed" => strtotime('now')
        ];

        return JWT::encode($payload, $key);
    }
}
