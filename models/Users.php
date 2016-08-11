<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use Yii;


class Users extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;

    public $password;

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
          [['name', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'status'], 'required'],
            ['email', 'email'],
            ['name', 'string', 'min' => 2,'max' => 100],
            ['password', 'required', 'on' => 'create'],
            ['name', 'unique', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'message' => 'Эта почта уже зарегистрирована']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function findByUsername($name)
    {
        return static::findOne([
            'name' => $name
        ]);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ник',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Статус',
            'auth_key' => 'Auth Key',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления'

        ];
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->password_hash);
    }

    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return $this->getAuthKey() === $authKey;
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

//    public function beforeSave($insert)
//    {
//        if(parent::beforeSave($insert))
//        {
//            if($this->isNewRecord)
//            {
//                $this->auth_key = \Yii::$app->security->generateRandomString();
//            }
//            return true;
//        }
//        return false;
//    }
}