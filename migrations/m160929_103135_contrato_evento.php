<?php

use dektrium\user\migrations\Migration;

class m160929_103135_contrato_evento extends Migration
{
    public function up()
    {
        $this->createTable('{{%contrato_evento}}', [
            'id_contrato'                   => $this->integer()->notNull(),
            'id_evento'                     => $this->integer()->notNull(),

        ], $this->tableOptions);

        $this->addForeignKey('{{%fk_contrato}}', '{{%contrato_evento}}', 'id_contrato', '{{%evento}}', 'id', $this->cascade, $this->restrict);
        $this->addForeignKey('{{%fk_evento}}', '{{%contrato_evento}}', 'id_evento', '{{%evento}}', 'id', $this->cascade, $this->restrict);
    }

  public function down()
  {

  }
}
