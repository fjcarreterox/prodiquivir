<?php
use Orm\Model;

class Model_Proveedor extends Model
{
	protected static $_properties = array(
		'id',
		'nombre',
		'domicilio',
		'poblacion',
		'nifcif',
		'telefono',
		'tipo',
        'comentario',
        'envases',
        'liquidado',
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
		$val->add_field('nombre', 'Nombre', 'required|max_length[50]');
		$val->add_field('domicilio', 'Domicilio', 'required|max_length[120]');
		$val->add_field('poblacion', 'Poblacion', 'required|max_length[50]');
		$val->add_field('nifcif', 'Nifcif', 'required|max_length[9]');
		$val->add_field('telefono', 'Telefono', 'required|max_length[15]');
		$val->add_field('tipo', 'Tipo', 'required|max_length[15]');
        $val->add_field('comentario', 'Comentario', 'required|max_length[255]');
        $val->add_field('envases', 'Envases', 'required|max_length[255]');
        $val->add_field('liquidado', 'Liquidado', 'required|valid_string[numeric]');
		return $val;
	}

}
