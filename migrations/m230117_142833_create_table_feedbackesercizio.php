<?php

use yii\db\Migration;

/**
 * Class m230117_142833_create_table_feedbackesercizio
 */
class m230117_142833_create_table_feedbackesercizio extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("feedbackesercizio", [
            "id_feedback" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "descr" => $this->string(1000)->notNull(),
            'result' => 'ENUM("Svolto", "Non svolto") NOT NULL',
            "evaluation" => $this->integer(1)->notNull(),
            "duration" => $this->string(32)->notNull(),
            "file" => $this->binary(null),
            "file_type" => $this->string(64),
            "esercizio_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_esercizio_feedback", "feedbackesercizio", "esercizio_id", "esercizio", "id_esercizio",'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_esercizio_feedback", "feedbackesercizio");
        $this->dropTable("feedbackesercizio");
    }

}
