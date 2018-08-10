<?php
use Orm\Model;

class Model_Albaran extends Model
{
	protected static $_properties = array(
		'id',
		'idalbaran',
		'identrega',
		'idproveedor',
		'fecha',
        'comentario',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('idalbaran', 'Idalbaran', 'required|valid_string[numeric]');
		$val->add_field('identrega', 'Identrega', 'valid_string[numeric]');
		$val->add_field('idproveedor', 'Idproveedor', 'valid_string[numeric]');

		return $val;
	}

}
