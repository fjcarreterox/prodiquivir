<?php

namespace Fuel\Migrations;

class Create_entregas
{
	public function up()
	{
		\DBUtil::create_table('entregas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'fecha' => array('type' => 'date'),
			'albaran' => array('constraint' => 5, 'type' => 'int'),
			'variedad' => array('constraint' => 11, 'type' => 'int'),
			'tam' => array('constraint' => 4, 'type' => 'int'),
			'total' => array('constraint' => 4, 'type' => 'int'),
			'rate_picado' => array('constraint' => 2, 'type' => 'int'),
			'rate_molestado' => array('constraint' => 2, 'type' => 'int'),
			'rate_morado' => array('constraint' => 2, 'type' => 'int'),
			'rate_mosca' => array('constraint' => 2, 'type' => 'int'),
			'rate_azofairon' => array('constraint' => 2, 'type' => 'int'),
			'rate_agostado' => array('constraint' => 2, 'type' => 'int'),
			'rate_granizado' => array('constraint' => 2, 'type' => 'int'),
			'rate_perdigon' => array('constraint' => 2, 'type' => 'int'),
			'rate_taladro' => array('constraint' => 2, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('entregas');
	}
}