<?php

use yii\db\Migration;

/**
 * Class m230112_161430_create_table_referto
 */
class m230112_161430_create_table_referto extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("referto", [
            "id_referto" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "name_referto" =>$this->string(32)->notNull(),
            "descr" => $this->string(1000)->notNull(),
            "diagnosi_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_diagnosi_referto", "referto", "diagnosi_id", "diagnosi", "id_diagnosi",'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_diagnosi_referto", "referto");
        $this->dropTable("referto");
    }

}
