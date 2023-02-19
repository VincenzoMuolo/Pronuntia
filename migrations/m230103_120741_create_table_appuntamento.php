<?php

use yii\db\Migration;

/**
 * Class m230103_120741_create_table_Appuntamento
 */
class m230103_120741_create_table_appuntamento extends Migration
{
    
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable("appuntamento", [
            "id_date" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "date" => $this->datetime()->notNull(),
            'state' => 'ENUM("Libero", "Occupato") NOT NULL DEFAULT "Libero"',
            "logopedista_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_logopedista_appuntamento", "appuntamento", "logopedista_id", "logopedista", "id_logopedista",'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey("fk_logopedista_appuntamento", "appuntamento");
        $this->dropTable("appuntamento");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230105_120741_create_table_Appuntamento cannot be reverted.\n";

        return false;
    }
    */
}
