<?php

use yii\db\Migration;

/**
 * Class m221213_133135_create_table_user
 */
class m221213_133135_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("user", [
            "id_user" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "name" => $this->string(32)->notNull(),
            "surname" => $this->string(32)->notNull(),
            "email" => $this->string(128)->notNull(),
            "password" => $this->string(128)->notNull(),
            "auth_key" => $this->string(128)->unique()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("user");
    }

/*
// Use up()/down() to run migration code without a transaction.
public function up()
{
}
public function down()
{
echo "m221213_133135_create_table_user cannot be reverted.\n";
return false;
}
*/
}