<?php

use yii\db\Migration;

/**
 * Class m221213_141821_create_table_logopedista
 */
class m221213_141821_create_table_logopedista extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("logopedista", [
            "id_logopedista" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "mobile_phone" => $this->string(10)->notNull()->unique(),
            "address" => $this->string(128)->notNull(),
            "specs" => $this->string(128)->notNull(),
            "user_key" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_logopedista", "logopedista", "user_key", "user", "id_user",'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_logopedista", "logopedista");
        $this->dropTable("logopedista");
    }

/*
// Use up()/down() to run migration code without a transaction.
public function up()
{
}
public function down()
{
echo "m221213_141821_create_table_logopedista cannot be reverted.\n";
return false;
}
*/
}