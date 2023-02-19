<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referto".
 *
 * @property int $id_referto
 * @property string $descr
 * @property int $diagnosi_id
 *
 * @property Diagnosi $diagnosi
 */
class Referto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descr', 'diagnosi_id', 'name_referto'], 'required'],
            [['diagnosi_id'], 'integer'],
            [['name_referto'], 'string', 'max' => 32],
            [['descr'], 'string', 'max' => 1000],
            [['diagnosi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Diagnosi::class, 'targetAttribute' => ['diagnosi_id' => 'id_diagnosi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_referto' => 'Id Referto',
            'name_referto' => 'Nome Referto',
            'descr' => 'Dettagli',
            'diagnosi_id' => 'Diagnosi ID',
        ];
    }

    public function beforeValidate() {
        if($this->isNewRecord){
            if($this->diagnosi_id==null){
                $query = (new \yii\db\Query)
                    ->select(['*'])
                    ->from('diagnosi')
                    ->orderBy(['id_diagnosi' => SORT_DESC])
                    ->limit(1);
                $records = $query->all();
                foreach ($records as $record) {
                    $id = $record['id_diagnosi'];
                }
                $this->diagnosi_id = $id;
            }
        }
        return parent::beforeValidate();
    }


    /**
     * Gets query for [[Diagnosi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosi()
    {
        return $this->hasOne(Diagnosi::class, ['id_diagnosi' => 'diagnosi_id']);
    }
}
