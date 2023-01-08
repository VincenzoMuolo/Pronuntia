<?php

use yii\db\Migration;

/**
 * Class m221221_134015_create_table_paziente
 */
class m221221_134015_create_table_paziente extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("paziente", [
            "id_paziente" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "name" => $this->string(255)->notNull(),
            "surname" => $this->string(255)->notNull(),
            "age" => $this->integer(2)->notNull(),
            "sex" => $this->string(10)->notNull(),
            "caregiver_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->createIndex("idx_paziente", "paziente", "caregiver_id");
        $this->addForeignKey("fk_paziente", "paziente", "caregiver_id", "caregiver", "id_caregiver");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_paziente", "paziente");
        $this->dropIndex("idx_paziente", "paziente");
        $this->dropTable("paziente");
    }
}
