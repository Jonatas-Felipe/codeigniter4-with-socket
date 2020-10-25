<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuario extends Migration {
  public function up() {
    $this->forge->addField([
      'id' => [
        'type'           => 'INT',
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'name'  => [
        'type'        => 'VARCHAR',
        'constraint'  => '64',
      ],
      'email'  => [
        'type'        => 'VARCHAR',
        'constraint'  => '128',
      ],
      'password'  => [
        'type'        => 'VARCHAR',
        'constraint'  => '32',
      ],
      'timestamp'  => [
        'type'        => 'TIMESTAMP',
      ]
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('usuario');
  }

  public function down() {
    $this->forge->dropTable('usuario');
  }
}
