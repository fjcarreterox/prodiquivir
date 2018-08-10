<?php
use Orm\Model;

class Model_Factura extends Model
{
	protected static $_properties = array(
		'id',
                'num_factura',
		'idprov',
		'fecha',
		'total',
		'cuota',
		'iva',
		'retencion',
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
		$val->add_field('idprov', 'Idprov', 'required|valid_string[numeric]');
                $val->add_field('num_factura', 'Número de factura', 'required|valid_string[numeric]');
        $val->add_field('fecha', 'Fecha', 'required');
		//$val->add_field('total', 'Total', 'valid_string[numeric]');
        $val->add_field('comentario', 'Comentario', 'max_length[255]');

		return $val;
	}
}