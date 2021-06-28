<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'				=> 'INT',
				'constraint'		=> 5,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'product_name' => [
				'type'			=> 'VARCHAR',
				'constraint'	=> '255',
			],
			'product_image' => [
				'type'			=> 'VARCHAR',
				'constraint'	=> '255',
			],
			'product_price' => [
				'type'	=> 'DOUBLE',
			],
			'product_description' => [
				'type'		=> 'TEXT',
				'null'		=> true,
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('product');
	}

	public function down()
	{
		$this->forge->dropTable('product');
	}
}
