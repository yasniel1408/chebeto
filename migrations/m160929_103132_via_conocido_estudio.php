<?php

use dektrium\user\migrations\Migration;

class m160929_103132_via_conocido_estudio extends Migration
{
   public function up()
    {
        $this->createTable('{{%via_conocido_estudio}}', [
            'id'                 => $this->primaryKey(),
            'nombre'             => $this->string()->notNull(),
            'descripcion'        => $this->text(),

        ], $this->tableOptions);

    }

  public function down()
  {

  }
}
