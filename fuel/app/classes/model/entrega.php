<?php
use Orm\Model;

class Model_Entrega extends Model
{
	protected static $_properties = array(
		'id',
		'fecha',
		'albaran',
		'variedad',
		'tam',
		'total',
		'envases',
		'rate_picado',
		'rate_molestado',
		'rate_morado',
		'rate_mosca',
		'rate_azofairon',
		'rate_agostado',
		'rate_granizado',
		'rate_perdigon',
		'rate_taladro',
        'idpuesto',
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
		$val->add_field('fecha', 'Fecha', 'required');
		$val->add_field('variedad', 'Variedad', 'required|valid_string[numeric]');
		$val->add_field('tam', 'Tam', 'valid_string[numeric]');
		$val->add_field('total', 'Total', 'required|valid_string[numeric]');
		$val->add_field('envases', 'Envases prestados', 'required|max_length[255]');
		$val->add_field('rate_picado', 'Rate Picado', 'required|valid_string[numeric]');
		$val->add_field('rate_molestado', 'Rate Molestado', 'required|valid_string[numeric]');
		$val->add_field('rate_morado', 'Rate Morado', 'required|valid_string[numeric]');
		$val->add_field('rate_mosca', 'Rate Mosca', 'required|valid_string[numeric]');
		$val->add_field('rate_azofairon', 'Rate Azofairon', 'required|valid_string[numeric]');
		$val->add_field('rate_agostado', 'Rate Agostado', 'required|valid_string[numeric]');
		$val->add_field('rate_granizado', 'Rate Granizado', 'required|valid_string[numeric]');
		$val->add_field('rate_perdigon', 'Rate Perdigon', 'required|valid_string[numeric]');
		$val->add_field('rate_taladro', 'Rate Taladro', 'required|valid_string[numeric]');
        $val->add_field('idpuesto', 'Puesto', 'required|valid_string[numeric]');

		return $val;
	}

}
