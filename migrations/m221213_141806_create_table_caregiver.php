<?php

use yii\db\Migration;

/**
 * Class m221213_141806_create_table_caregiver
 */
class m221213_141806_create_table_caregiver extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("caregiver", [
            "id_caregiver" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "mobile_phone" => $this->string()->notNull()->unique(),
            "user_key" => $this->integer()->notNull()->unsigned()
        ]);
        $this->createIndex("idx_caregiver", "caregiver", "user_key");
        $this->addForeignKey("fk_caregiver", "caregiver", "user_key", "user", "id_user");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_caregiver", "caregiver");
        $this->dropIndex("idx_caregiver", "caregiver");
        $this->dropTable("caregiver");
    }

/*
// Use up()/down() to run migration code without a transaction.
public function up()
{
}
public function down()
{
echo "m221213_141806_create_table_caregiver cannot be reverted.\n";
return false;
}
*/
}