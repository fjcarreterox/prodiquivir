<?php
use Orm\Model;

class Model_Variedad extends Model
{
	protected static $_properties = array(
		'id',
		'nombre',
		'en_anticipo',
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
		$val->add_field('nombre', 'Nombre', 'required|max_length[30]');
		$val->add_field('en_anticipo', 'En Anticipo', 'required');

		return $val;
	}

}
