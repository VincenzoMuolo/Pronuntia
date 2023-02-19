<?php

namespace app\models;
use app\models\Paziente;
use Yii;

/**
 * This is the model class for table "prenotazione".
 *
 * @property int $id_prenotazione
 * @property int $logopedista_id
 * @property int $caregiver_id
 * @property int $paziente_id
 * @property string $date
 *
 * @property Caregiver $caregiver
 * @property Logopedista $logopedista
 * @property Paziente $paziente
 */
class Prenotazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prenotazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logopedista_id', 'caregiver_id', 'paziente_id', 'date_id'], 'required'],
            [['logopedista_id', 'caregiver_id', 'paziente_id', 'date_id'], 'integer'],
            [['caregiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Caregiver::class, 'targetAttribute' => ['caregiver_id' => 'id_caregiver']],
            [['logopedista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::class, 'targetAttribute' => ['logopedista_id' => 'id_logopedista']],
            [['paziente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paziente::class, 'targetAttribute' => ['paziente_id' => 'id_paziente']],
            [['date_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appuntamento::class, 'targetAttribute' => ['date_id' => 'id_date']],
        ];
    }
    public function beforeValidate(){
        if($this->isNewRecord) {
            $tempPaziente = new Paziente();
            $this->caregiver_id=$tempPaziente->sessionCaregiver();
        }
        return parent::beforeValidate();
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prenotazione' => 'Id Prenotazione',
            'logopedista_id' => 'Id Logopedista',
            'caregiver_id' => 'Caregiver',
            'paziente_id' => 'Paziente',
            'date_id' => 'Data',
        ];
    }

    /**
     * Gets query for [[Caregiver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaregiver()
    {
        return $this->hasOne(Caregiver::class, ['id_caregiver' => 'caregiver_id']);
    }

    /**
     * Gets query for [[Logopedista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogopedista()
    {
        return $this->hasOne(Logopedista::class, ['id_logopedista' => 'logopedista_id']);
    }

    /**
     * Gets query for [[Paziente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaziente()
    {
        return $this->hasOne(Paziente::class, ['id_paziente' => 'paziente_id']);
    }
}
