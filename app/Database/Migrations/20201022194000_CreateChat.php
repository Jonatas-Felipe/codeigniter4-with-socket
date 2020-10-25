<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChat extends Migration {
  public function up() {
    $this->forge->addField([
      'id' => [
        'type'           => 'INT',
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'user_id'  => [
        'type' => 'INT',
      ],
      'id_user'  => [
        'type' => 'INT',
      ],
      'timestamp'  => [
        'type'        => 'TIMESTAMP',
      ]
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('chat');
  }

  public function down() {
    $this->forge->dropTable('chat');
  }
}
