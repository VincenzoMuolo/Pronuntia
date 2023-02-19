<?php

use yii\db\Migration;

/**
 * Class m230112_144936_create_table_diagnosi
 */
class m230112_144936_create_table_diagnosi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("diagnosi", [
            "id_diagnosi" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "name_diagnosi" => $this->string(64)->notNull(),
            "logopedista_id" => $this->integer()->notNull()->unsigned(),
            "paziente_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_logopedista_diagnosi", "diagnosi", "logopedista_id", "logopedista", "id_logopedista");
        $this->addForeignKey("fk_paziente_diagnosi", "diagnosi", "paziente_id", "paziente", "id_paziente");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_logopedista_diagnosi", "diagnosi");
        $this->dropForeignKey("fk_paziente_diagnosi", "diagnosi");
        $this->dropTable("diagnosi");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230112_144936_create_table_diagnosi cannot be reverted.\n";

        return false;
    }
    */
}
