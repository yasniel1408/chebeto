<?php

use dektrium\user\migrations\Migration;

class m160929_103136_tiempo_no_trabajo extends Migration
{
    public function up()
    {
        $this->createTable('{{%tiempo_no_trabajo}}', [
            'id'                 => $this->primaryKey(),
            'nombre'             => $this->string()->notNull(),
            'fecha_inicio'       => $this->datetime(),
            'fecha_final'        => $this->datetime(),

        ], $this->tableOptions);

    }

  public function down()
  {

  }
}
