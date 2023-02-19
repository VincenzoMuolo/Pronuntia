<?php

use yii\db\Migration;

/**
 * Class m230107_204843_create_table_terapia
 */
class m230107_204843_create_table_terapia extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable("terapia", [
            "id_terapia" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "name_terapia" => $this->string(64)->notNull(),
            "descr" => $this->string(1000)->notNull(),
            "logopedista_id" => $this->integer()->notNull()->unsigned(),
            "paziente_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_logopedista_terapia", "terapia", "logopedista_id", "logopedista", "id_logopedista",'CASCADE','CASCADE');
        $this->addForeignKey("fk_paziente_terapia", "terapia", "paziente_id", "paziente", "id_paziente",'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey("fk_logopedista_terapia", "terapia");
        $this->dropForeignKey("fk_paziente_terapia", "terapia");
        $this->dropTable("terapia");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230107_204843_create_table_terapia cannot be reverted.\n";

        return false;
    }
    */
}
