<?php

namespace Fuel\Migrations;

class Create_facturas
{
	public function up()
	{
		\DBUtil::create_table('facturas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idprov' => array('constraint' => 11, 'type' => 'int'),
            'fecha' => array('type' => 'date'),
			'total' => array('constraint' => 11, 'type' => 'int'),
            'comentario' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('facturas');
	}
}