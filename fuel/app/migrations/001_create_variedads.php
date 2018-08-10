<?php

namespace Fuel\Migrations;

class Create_variedads
{
	public function up()
	{
		\DBUtil::create_table('variedads', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'nombre' => array('constraint' => 30, 'type' => 'varchar'),
			'en_anticipo' => array('constraint' => 4, 'type' => 'tinyint'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('variedads');
	}
}