<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agenda".
 *
 * @property int $id_date
 * @property string $date
 * @property string $state
 * @property int $logopedista_id
 *
 * @property Logopedista $logopedista
 */
class Appuntamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appuntamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'logopedista_id'], 'required'],
            [['date'], 'safe'],
            [['date'], 'datetime', 'format' => 'yyyy-MM-dd HH:mm'],
            [['state'], 'string'],
            [['logopedista_id'], 'integer'],
            [['logopedista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Logopedista::class, 'targetAttribute' => ['logopedista_id' => 'id_logopedista']],
        ];
    }

    public function beforeValidate(){
        if($this->isNewRecord) {
            $this->logopedista_id= $this->sessionLogopedista();
        }
        return parent::beforeValidate();
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_date' => 'Id Data',
            'date' => 'Data e Ora',
            'state' => 'Stato',
            'logopedista_id' => 'Logopedista ID',
        ];
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
