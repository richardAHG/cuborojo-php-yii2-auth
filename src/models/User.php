<?php

namespace cuborojo\yii2\auth\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [["username", "password", "firstname"], 'require'],
            [["status"], 'integer'],
            [["password", "date_created"], 'string'],
            [["firstname", "lastname"], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'firstname' => 'Nombres',
            'lastname' => 'Apellidos',
            'date_created' => 'Fecha de Creacion',
            'status' => 'Estado',
        ];
    }

    public static function validateUsername($username)
    {
        $user = self::find()
        ->where(
            "status=:status and username=:username",
            [
                ":status" => self::STATUS_ACTIVE,
                ":username" => $username,
            ]
        )
        ->one();
        
        return $user;
    }

    public static function exists()
    {
        $userID = self::find()
        ->where("status=:status", [":status" => self::STATUS_ACTIVE])
        ->scalar();
        
        return $userID;
    }
}
