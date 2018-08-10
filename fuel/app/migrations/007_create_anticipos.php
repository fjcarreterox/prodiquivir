<?php

namespace Fuel\Migrations;

class Create_anticipos
{
	public function up()
	{
		\DBUtil::create_table('anticipos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'fecha' => array('type' => 'date'),
			'idprov' => array('constraint' => 11, 'type' => 'int'),
			'numcheque' => array('constraint' => 11, 'type' => 'int'),
			'idbanco' => array('constraint' => 11, 'type' => 'int'),
			'cuantia' => array('type' => 'decimal'),
			'recogido' => array('type' => 'tinyint'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('anticipos');
	}
}