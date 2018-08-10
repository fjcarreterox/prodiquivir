<?php

namespace Fuel\Migrations;

class Create_lineas
{
	public function up()
	{
		\DBUtil::create_table('lineas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idfactura' => array('constraint' => 11, 'type' => 'int'),
			'orden' => array('constraint' => 11, 'type' => 'int'),
			'concepto' => array('constraint' => 255, 'type' => 'varchar'),
			'precio' => array('type' => 'decimal'),
			'kg' => array('constraint' => 11, 'type' => 'int'),
			'importe' => array('type' => 'decimal'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('lineas');
	}
}