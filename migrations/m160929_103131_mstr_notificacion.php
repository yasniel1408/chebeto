<?php
//
//use dektrium\user\migrations\Migration;
//
//class m160929_103131_mstr_notificacion extends Migration
//{
//   public function up()
//    {
//        $this->createTable('{{%mstr_notificacion}}', [
//            '$id_notificacion'       => $this->integer()->notNull(),
//            '$id_asunto'             => $this->integer()->notNull(),
//            '$usuario_destino'       => $this->integer()->notNull(),
//            '$usuario_origen'        => $this->integer()->notNull(),
//            '$fecha_creacion'        => $this->string()->notNull(),
//            '$leido'                 => $this->integer()->notNull(),
//
//        ], $this->tableOptions);
//
//        //$this->addForeignKey('{{%fk_user}}', '{{%user_persona}}', '$id_user', '{{%user}}', '$id', $this->cascade, $this->restrict);
//        //$this->addForeignKey('{{%fk_persona}}', '{{%user_persona}}', '$id_persona', '{{%persona}}', '$id', $this->cascade, $this->restrict);
//    }
//
//  public function down()
//  {
//
//  }
//}
