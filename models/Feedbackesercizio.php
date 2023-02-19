<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedbackesercizio".
 *
 * @property int $id_feedback
 * @property string $descr
 * @property string $result
 * @property int $evaluation
 * @property string|null $file
 * @property string|null $file_type
 * @property int $esercizio_id
 *
 * @property Esercizio $esercizio
 */
class Feedbackesercizio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedbackesercizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descr', 'result', 'evaluation', 'esercizio_id','duration'], 'required'],
            [['result'], 'string'],
            [['evaluation', 'esercizio_id'], 'integer'],
            [['descr'], 'string', 'max' => 1000],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['pdf', 'mp3', 'mp4', 'wav']],
            [['file_type'], 'string', 'max' => 64],
            [['esercizio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Esercizio::class, 'targetAttribute' => ['esercizio_id' => 'id_esercizio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_feedback' => 'Id Feedback',
            'descr' => 'Descrivi lo svolgimento dell\'esercizio',
            'result' => 'Esito',
            'evaluation' => 'Selezionate di seguito una valutazione per l\'esercizio svolto',
            'duration' => 'Tempo impiegato',
            'file' => 'File',
            'file_type' => 'Tipo File',
            'esercizio_id' => 'Esercizio ID',
        ];
    }

    /**
     * Gets query for [[Esercizio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEsercizio()
    {
        return $this->hasOne(Esercizio::class, ['id_esercizio' => 'esercizio_id']);
    }
}
