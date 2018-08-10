<?php

namespace Fuel\Migrations;

class Create_proveedors
{
	public function up()
	{
		\DBUtil::create_table('proveedors', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'nombre' => array('constraint' => 50, 'type' => 'varchar'),
			'domicilio' => array('constraint' => 120, 'type' => 'varchar'),
			'poblacion' => array('constraint' => 50, 'type' => 'varchar'),
			'nifcif' => array('constraint' => 9, 'type' => 'varchar'),
			'telefono' => array('constraint' => 9, 'type' => 'int'),
			'tipo' => array('constraint' => 15, 'type' => 'varchar'),
            'comentario' => array('constraint' => 2552, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('proveedors');
	}
}