<?php

namespace app\models;

use Yii;
use \app\models\User;

/**
 * This is the model class for table "logopedista".
 *
 * @property int $id_logopedista
 * @property string $name
 * @property string $surname
 * @property string $mobile_phone
 * @property string $address
 * @property string $specs
 * @property int $user_key
 *
 * @property User $userKey
 */
class Logopedista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logopedista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mobile_phone', 'address', 'specs', 'user_key'], 'required'],
            [['user_key'], 'integer'],
            [['mobile_phone', 'address', 'specs'], 'string', 'max' => 255],
            [['mobile_phone'], 'unique'],
            [['user_key'], 'unique'],
            [['user_key'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_key' => 'id_user']],
        ];
    }

    public function beforeValidate(){
        $query = User::find()->count();
        if($this->isNewRecord){
            $this->user_key= $query;
        }
        return parent::beforeValidate();
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_logopedista' => 'Id Logopedista',
            'mobile_phone' => 'Telefono',
            'address' => 'Indirizzo',
            'specs' => 'Specializzazione',
            'user_key' => 'User Key',
        ];
    }

    /**
     * Gets query for [[UserKey]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserKey()
    {
        return $this->hasOne(User::class, ['id_user' => 'user_key']);
    }
}
