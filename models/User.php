<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id_user
 * @property string $username;
 * @property string $email
 * @property string $password
 * @property string $auth_key
 *
 * @property Caregiver[] $caregivers
 * @property Logopedista[] $logopedisti
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'surname', 'email', 'password', 'auth_key'], 'required'],
            [['email'], 'email'],
            [['auth_key'], 'string', 'max'=>128],
            [['name', 'surname','email', 'password'], 'string', 'max' => 255],
            [['email'],'unique'],
            [['auth_key'],'unique'],
        ];
    }
    public function beforeValidate(){
        if($this->isNewRecord) {
            $this->setAuthKey();
        }
        return parent::beforeValidate();
    }
    private function setAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString(128);
    }
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if($this->isNewRecord) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_user' => 'Id User',
            'name' => 'Nome',
            'surname' => 'Cognome',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Authorization key'
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id_user) {
        /* isset(self::$users[$id]) ? new static (self::$users[$id]) : null */
        return self::findOne($id_user);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        /* foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static ($user);
            }
        } */

        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id_user;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($auth_key) {
        return $this->auth_key === $auth_key;
    }

    /**
     * Gets query for [[Caregivers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaregivers() {
        return $this->hasMany(Caregiver::class, ['user_key' => 'id_user']);
    }
    /**
     * Gets query for [[Logopedista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogopedisti() {
        return $this->hasMany(Logopedista::class, ['user_key' => 'id_user']);
    }

    public static function findByEmail($email) {
        return self::findOne(['email' => $email]);
    }
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}