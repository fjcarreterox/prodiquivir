<?php
use Orm\Model;

class Model_Linea extends Model
{
	protected static $_properties = array(
		'id',
		'idfactura',
		'orden',
		'concepto',
		'precio',
		'kg',
		'importe',
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
		$val->add_field('idfactura', 'Idfactura', 'required|valid_string[numeric]');
		$val->add_field('orden', 'Orden', 'required|valid_string[numeric]');
		$val->add_field('concepto', 'Concepto', 'required|max_length[255]');
		$val->add_field('precio', 'Precio', 'required');
		$val->add_field('kg', 'Kg', 'required|valid_string[numeric]');
		$val->add_field('importe', 'Importe', 'required');

		return $val;
	}

}
