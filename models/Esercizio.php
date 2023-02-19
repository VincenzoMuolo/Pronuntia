<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "esercizio".
 *
 * @property int $id_esercizio
 * @property string $name_esercizio
 * @property string $descr
 * @property string|null $file
 * @property string|null $file_type
 * @property int $logopedista_id
 * @property int $terapia_id
 *
 * @property Logopedista $logopedista
 * @property Terapia $terapia
 */
class Esercizio extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'esercizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_esercizio', 'descr', 'logopedista_id', 'terapia_id','duration'], 'required'],
            [['logopedista_id', 'terapia_id'], 'integer'],
            [['name_esercizio', 'file_type'], 'string', 'max' => 64],
            [['descr'], 'string', 'max' => 1000],            
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['pdf', 'mp3', 'mp4', 'wav']],
            [['logopedista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::class, 'targetAttribute' => ['logopedista_id' => 'id_logopedista']],
            [['terapia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Terapia::class, 'targetAttribute' => ['terapia_id' => 'id_terapia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_esercizio' => 'Id Esercizio',
            'name_esercizio' => 'Nome Esercizio',
            'descr' => 'Descrizione Esercizio',
            'file' => 'Allegato',
            'duration' => 'Durata',
            'file_type' => 'Tipo file',
            'logopedista_id' => 'Logopedista ID',
            'terapia_id' => 'Terapia',
        ];
    }

    public function beforeValidate(){
        if($this->isNewRecord) {
            $this->logopedista_id= $this->sessionLogopedista();
            
        }
        return parent::beforeValidate();
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
     * Gets query for [[Terapia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTerapia()
    {
        return $this->hasOne(Terapia::class, ['id_terapia' => 'terapia_id']);
    }
    public function sessionLogopedista(){
        $idUtenteAttivo = Yii::$app->user->id;
        if($idUtenteAttivo!=null){
            $user_id = User::findOne($idUtenteAttivo);
            $query = (new \yii\db\Query())
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'logopedista', 'user.id_user = logopedista.user_key')
            ->where(['logopedista.user_key' => $user_id]);
            $logopedista = $query->one();
        }
        return $logopedista['id_logopedista'];
    }
}
