<?php

use yii\db\Migration;

/**
 * Class m230107_164450_create_table_prenotazioneSearch
 */
class m230107_164450_create_table_prenotazioneSearch extends Migration
{
    public function safeUp() {
        $this->createTable("prenotazioneSearch", [
            "id_prenotazione" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "logopedista_id" => $this->integer()->notNull()->unsigned()
        ]);
    }
    public function safeDown() {
        $this->dropTable("prenotazioneSearch");
    }

}
