<?php

use yii\db\Migration;

/**
 * Class m230109_125051_create_table_test
 */
class m230109_125051_create_table_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("test", [
            "id_test" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "name_test" => $this->string(64)->notNull(),
            "descr" => $this->string(1000)->notNull(),
            "link" => $this->string(255)->notNull(),
            "logopedista_id" => $this->integer()->notNull()->unsigned(),
            "paziente_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_logopedista_test", "test", "logopedista_id", "logopedista", "id_logopedista",'CASCADE','CASCADE');
        $this->addForeignKey("fk_paziente_test", "test", "paziente_id", "paziente", "id_paziente",'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_logopedista_test", "test");
        $this->dropForeignKey("fk_paziente_test", "test");
        $this->dropTable("test");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230109_125051_create_table_tesAutovalutazione cannot be reverted.\n";

        return false;
    }
    */
}
