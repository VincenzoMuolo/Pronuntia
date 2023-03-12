<?php

use yii\db\Migration;

/**
 * Class m230111_140019_create_table_esercizio
 */
class m230111_140019_create_table_esercizio extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("esercizio", [
            "id_esercizio" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "name_esercizio" => $this->string(64)->notNull(),
            "descr" => $this->string(1000)->notNull(),
            "duration" => $this->string(32)->notNull(),
            "file" => $this->getDb()->getSchema()->createColumnSchemaBuilder('longblob'),
            "file_type" => $this->string(64),
            "logopedista_id" => $this->integer()->notNull()->unsigned(),
            "terapia_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_logopedista_esercizio", "esercizio", "logopedista_id", "logopedista", "id_logopedista",'CASCADE','CASCADE');
        $this->addForeignKey("fk_terapia_esercizio", "esercizio", "terapia_id", "terapia", "id_terapia",'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_logopedista_esercizio", "esercizio");
        $this->dropForeignKey("fk_terapia_esercizio", "esercizio");
        $this->dropTable("esercizio");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230111_140019_create_table_esercizio cannot be reverted.\n";

        return false;
    }
    */
}
