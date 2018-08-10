<?php

namespace Fuel\Migrations;

class Create_albarans
{
	public function up()
	{
		\DBUtil::create_table('albarans', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'IdAlbaran' => array('constraint' => 11, 'type' => 'int'),
			'IdEntrega' => array('constraint' => 11, 'type' => 'int'),
			'IdProveedor' => array('constraint' => 11, 'type' => 'int'),
            'comentario' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('albarans');
	}
}