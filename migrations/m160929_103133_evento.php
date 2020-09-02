<?php

use dektrium\user\migrations\Migration;

class m160929_103133_evento extends Migration
{
   public function up()
    {
        $this->createTable('{{%evento}}', [
            'id'                 => $this->primaryKey(),
            'nombre'             => $this->string()->notNull(),
            'descripcion'        => $this->text(),
            'fecha'              => $this->date(),
            'duracion'           => $this->time(),

        ], $this->tableOptions);

    }

  public function down()
  {

  }
}
