<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMessages extends Migration {
  public function up() {
    $this->forge->addField([
      'id' => [
        'type'           => 'INT',
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'message'  => [
        'type' => 'LONGTEXT',
      ],
      'user_id'  => [
        'type' => 'INT',
      ],
      'recipient_id'  => [
        'type' => 'INT',
      ],
      'chat_id'  => [
        'type' => 'INT',
      ],
      'timestamp'  => [
        'type'        => 'TIMESTAMP',
      ]
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('messages');
  }

  public function down() {
    $this->forge->dropTable('messages');
  }
}
