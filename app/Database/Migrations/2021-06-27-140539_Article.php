<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Article extends Migration
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
			'article_creator' => [
				'type'			=> 'INT',
				'constraint'	=> 5,
			],
			'article_title' => [
				'type'			=> 'VARCHAR',
				'constraint'	=> '255',
			],
			'article_image' => [
				'type'			=> 'VARCHAR',
				'constraint'	=> '255',
			],
			'article_content' => [
				'type'		=> 'TEXT',
				'null'		=> true,
			],
			'article_description' => [
				'type'		=> 'TEXT',
				'null'		=> true,
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('article');
	}

	public function down()
	{
		$this->forge->dropTable('article');
	}
}
