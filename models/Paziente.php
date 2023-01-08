<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paziente".
 *
 * @property int $id_paziente
 * @property string $name
 * @property string $surname
 * @property int $age
 * @property string $sex
 * @property int $caregiver_id
 *
 * @property Caregiver $caregiver
 */
class Paziente extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'paziente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'surname', 'age', 'sex', 'caregiver_id'], 'required'],
            [['age', 'caregiver_id'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 10],
            [['caregiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Caregiver::class, 'targetAttribute' => ['caregiver_id' => 'id_caregiver']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_paziente' => 'Id Paziente',
            'name' => 'Nome',
            'surname' => 'Cognome',
            'age' => 'Età',
            'sex' => 'Sesso',
            'caregiver_id' => 'Caregiver ID',
        ];
    }

    public function beforeValidate(){
        if($this->isNewRecord) {
            $this->caregiver_id= $this->sessionCaregiver();
        }
        return parent::beforeValidate();
    }

    /**
     * Gets query for [[Caregiver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaregiver() {
        return $this->hasOne(Caregiver::class, ['id_caregiver' => 'caregiver_id']);
    }
    public function sessionCaregiver(){
        $idUtenteAttivo = Yii::$app->user->id;
        if($idUtenteAttivo!=null){
            $user_id = User::findOne($idUtenteAttivo);
            $query = (new \yii\db\Query())
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'caregiver', 'user.id_user = caregiver.user_key')
            ->where(['caregiver.user_key' => $user_id]);
            $caregiver = $query->one();
        }
        return $caregiver['id_caregiver'];
    }

}
