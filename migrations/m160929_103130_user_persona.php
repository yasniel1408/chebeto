<?php

use dektrium\user\migrations\Migration;

class m160929_103130_user_persona extends Migration
{
   public function up()
    {
        $this->createTable('{{%user_persona}}', [
            'id_user'                   => $this->integer()->notNull(),
            'id_persona'             => $this->integer()->notNull(),
            
        ], $this->tableOptions);

        $this->addForeignKey('{{%fk_user}}', '{{%user_persona}}', 'id_user', '{{%user}}', 'id', $this->cascade, $this->restrict);
        $this->addForeignKey('{{%fk_persona}}', '{{%user_persona}}', 'id_persona', '{{%persona}}', 'id', $this->cascade, $this->restrict);
    }

  public function down()
  {
    
  }
}
