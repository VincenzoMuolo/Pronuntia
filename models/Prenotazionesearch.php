<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prenotazionesearch".
 *
 * @property int $id_prenotazione
 * @property int $logopedista_id
 */
class Prenotazionesearch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prenotazionesearch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logopedista_id'], 'required'],
            [['logopedista_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prenotazione' => 'Id Prenotazione',
            'logopedista_id' => 'Logopedista',
        ];
    }
}
