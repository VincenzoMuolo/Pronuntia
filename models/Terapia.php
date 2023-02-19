<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "terapia".
 *
 * @property int $id_terapia
 * @property string $name_terapia
 * @property string $descr
 * @property int $logopedista_id
 * @property int $paziente_id
 *
 * @property Logopedista $logopedista
 * @property Paziente $paziente
 */
class Terapia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'terapia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_terapia', 'descr', 'logopedista_id', 'paziente_id'], 'required'],
            [['logopedista_id', 'paziente_id'], 'integer'],
            [['name_terapia'], 'string', 'max' => 64],
            [['descr'], 'string', 'max' => 1000],
            [['logopedista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::class, 'targetAttribute' => ['logopedista_id' => 'id_logopedista']],
            [['paziente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paziente::class, 'targetAttribute' => ['paziente_id' => 'id_paziente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_terapia' => 'Id Terapia',
            'name_terapia' => 'Nome Terapia',
            'descr' => 'Descrizione',
            'logopedista_id' => 'Logopedista',
            'paziente_id' => 'Paziente',
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
     * Gets query for [[Paziente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaziente()
    {
        return $this->hasOne(Paziente::class, ['id_paziente' => 'paziente_id']);
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
