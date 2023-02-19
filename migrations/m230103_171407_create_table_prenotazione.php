<?php

use yii\db\Migration;

/**
 * Class m230103_171407_create_table_prenotazione
 */
class m230103_171407_create_table_prenotazione extends Migration
{
    public function safeUp() {
        $this->createTable("prenotazione", [
            "id_prenotazione" => $this->primaryKey()->unsigned()->append("AUTO_INCREMENT"),
            "logopedista_id" => $this->integer()->notNull()->unsigned(),
            "caregiver_id" => $this->integer()->notNull()->unsigned(),
            "paziente_id" => $this->integer()->notNull()->unsigned(),
            "date_id" => $this->integer()->notNull()->unsigned()
        ]);
        $this->addForeignKey("fk_logopedista_prenotazione", "prenotazione", "logopedista_id", "logopedista", "id_logopedista",'CASCADE','CASCADE');
        $this->addForeignKey("fk_caregiver_prenotazione", "prenotazione", "caregiver_id", "caregiver", "id_caregiver",'CASCADE','CASCADE');
        $this->addForeignKey("fk_paziente_prenotazione", "prenotazione", "paziente_id", "paziente", "id_paziente",'CASCADE','CASCADE');
        $this->addForeignKey("fk_date_prenotazione", "prenotazione", "date_id", "appuntamento", "id_date",'CASCADE','CASCADE');

    }
    public function safeDown() {
        $this->dropForeignKey("fk_logopedista_prenotazione", "prenotazione");
        $this->dropForeignKey("fk_caregiver_prenotazione", "prenotazione");
        $this->dropForeignKey("fk_paziente_prenotazione", "prenotazione");
        $this->dropForeignKey("fk_date_prenotazione", "prenotazione");
        $this->dropTable("prenotazione");
    }
}
