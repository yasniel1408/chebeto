<?php

use dektrium\user\migrations\Migration;

class m160929_103132_create_id_via_conocio_estudio_en_persona extends Migration
{
   public function up()
    {

        $this->addColumn('{{%persona}}', 'id_via_conocio_estudio', $this->integer());
        $this->addForeignKey('{{%fk_via_conocio_estudio}}', '{{%persona}}', 'id_via_conocio_estudio', '{{%via_conocido_estudio}}', 'id', $this->cascade, $this->restrict);

    }

  public function down()
  {

  }
}
