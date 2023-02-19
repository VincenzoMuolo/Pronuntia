<?php

namespace app\models;

use Yii;
use \app\models\User;

/**
 * This is the model class for table "caregiver".
 *
 * @property int $id_caregiver
 * @property string $name
 * @property string $surname
 * @property string $mobile_phone
 * @property int $user_key
 *
 * @property User $userKey
 */
class Caregiver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'caregiver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['mobile_phone', 'user_key'], 'required'],
            [['user_key'], 'integer'],
            [['mobile_phone'], 'string', 'max' => 10],
            [['mobile_phone'], 'unique'],
            [['user_key'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_key' => 'id_user']],
        ];
    }


    public function beforeValidate() {

        if($this->isNewRecord){
            $query = (new \yii\db\Query)
                ->select(['*'])
                ->from('user')
                ->orderBy(['id_user' => SORT_DESC])
                ->limit(1);
            $records = $query->all();
            foreach ($records as $record) {
                $id = $record['id_user'];
            }
            $this->user_key = $id;
        }
        return parent::beforeValidate();
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_caregiver' => 'Id Caregiver',
            'mobile_phone' => 'Telefono',
            'user_key' => 'User Key',
        ];
    }

    /**
     * Gets query for [[UserKey]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserKey() {
        return $this->hasOne(User::class, ['id_user' => 'user_key']);
    }

}
