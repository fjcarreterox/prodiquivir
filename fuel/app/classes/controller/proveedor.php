<?php
class Controller_Proveedor extends Controller_Template
{

	public function action_index(){
		$data['proveedors'] = Model_Proveedor::find('all',array('order_by' => 'nombre'));
        $data['intro'] = "Durante la presente campaña hay registrados";
		$this->template->title = "Proveedores";
		$this->template->content = View::forge('proveedor/index', $data);
	}

    public function action_activos(){
        $provs = Model_Proveedor::find('all',array('where'=>array('liquidado'=>0),'order_by' => 'nombre'));
        foreach($provs as $p){
			if(!Model_Albaran::find('first',array('where'=>array('idproveedor'=>$p->id,array('fecha', 'LIKE', '2023%'))))){
                unset($provs[$p->id]);
			}
        }
        $data['proveedors'] = $provs;
        $data['intro'] = "Durante la presente campaña hay activos (no liquidados)";
        $this->template->title = "Proveedores activos (no liquidados) en el sistema";
        $this->template->content = View::forge('proveedor/index', $data);
    }

    public function action_inactivos(){
        $provs = Model_Proveedor::find('all',array('order_by' => 'nombre'));
        foreach($provs as $p){
            if(Model_Albaran::find('first',array('where'=>array('idproveedor'=>$p->id,array('fecha', 'LIKE', '2023%'))))){
                unset($provs[$p->id]);
            }
        }
		//print_r($provs);
        $data['proveedors'] = $provs;
        $data['intro'] = "Durante la presente campaña hay aún inactivos";
        $this->template->title = "Proveedores inactivos en el sistema";
        $this->template->content = View::forge('proveedor/index', $data);
    }

    public function action_liquidados(){
        $provs = Model_Proveedor::find('all',array('where'=>array('liquidado'=>1),'order_by' => 'nombre'));
        $data['proveedors'] = $provs;
        $data['intro'] = "Durante la presente campaña se han liquidado";
        $this->template->title = "Proveedores liquidados en el sistema";
        $this->template->content = View::forge('proveedor/index', $data);
    }

    public function action_search()
    {
        if (Input::method() == 'POST'){
            $this->template->title = "Resultados de la búsqueda de proveedores";
            $str=\Fuel\Core\Input::post('searchq');

            if(strlen($str)<3){
                Session::set_flash('error', 'Debes escribir al menos tres letras para que la búsqueda sea efectiva.');
                Response::redirect('proveedor/search');
            }
            else{
                $provs = Model_Proveedor::find('all',array("where"=>array(array('nombre', 'LIKE', '%'.$str.'%'))));
                if(count($provs)>0) {
                    $data['proveedores'] = $provs;
                    $data['searchq'] = $str;
                    Session::set_flash('success', 'Resultados encontrados: ' . count($provs) . '.');
                    $this->template->content = View::forge('proveedor/resultados', $data);
                }
                else{
                    Session::set_flash('error', 'Resultados encontrados con "'.$str.'": ' . count($provs) . ' proveedores. Inténtalo con otra cadena.');
                    Response::redirect('proveedor/search');
                }
            }
        }
        else {
            $this->template->title = "Buscar un proveedor";
            $this->template->content = View::forge('proveedor/_form_search');
        }
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('proveedor');

		if ( ! $data['proveedor'] = Model_Proveedor::find($id))
		{
			Session::set_flash('error', 'Could not find proveedor #'.$id);
			Response::redirect('proveedor');
		}

		$this->template->title = "Proveedor";
		$this->template->content = View::forge('proveedor/view', $data);
	}

	public function action_create()
	{
        $unique_dni=true;

		if (Input::method() == 'POST')
		{
			$val = Model_Proveedor::validate('create');
            $p = Model_Proveedor::find('all',array('where'=>array('nifcif'=>Input::post('nifcif'))));
            if(count($p)>0){
                $unique_dni = false;
            }

			if ($val->run())
			{
                if($unique_dni) {
                    $proveedor = Model_Proveedor::forge(array(
                        'nombre' => Input::post('nombre'),
                        'domicilio' => Input::post('domicilio'),
                        'poblacion' => Input::post('poblacion'),
                        'nifcif' => Input::post('nifcif'),
                        'telefono' => Input::post('telefono'),
                        'tipo' => Input::post('tipo'),
                        'comentario' => Input::post('comentario'),
                        'envases' => Input::post('envases'),
                        'liquidado' => Input::post('liquidado'),
                    ));

                    if ($proveedor and $proveedor->save()) {
                        Session::set_flash('success', 'Proveedor añadido al sistema: ' . $proveedor->nombre . '.');
                        Response::redirect('proveedor');
                    } else {
                        Session::set_flash('error', 'No se pudo crear el nuevo proveedor.');
                    }
                }
                else{
                    Session::set_flash('error', 'No se pudo crear el nuevo proveedor. Ya existe uno en el sistema con el mismo DNI / CIF. Revisa los datos introducidos.');
                }
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "Alta de proveedor";
		$this->template->content = View::forge('proveedor/create');
	}

	public function action_edit($id = null, $tipo = null)
	{
		is_null($id) and Response::redirect('proveedor');

		if ( ! $proveedor = Model_Proveedor::find($id))
		{
			Session::set_flash('error', 'No encontramos nada sobre el proveedor #'.$id);
			Response::redirect('proveedor');
		}

		$val = Model_Proveedor::validate('edit');

		if ($val->run())
		{
			$proveedor->nombre = Input::post('nombre');
			$proveedor->domicilio = Input::post('domicilio');
			$proveedor->poblacion = Input::post('poblacion');
			$proveedor->nifcif = Input::post('nifcif');
			$proveedor->telefono = Input::post('telefono');
			$proveedor->tipo = Input::post('tipo');
            $proveedor->comentario = Input::post('comentario');
            $proveedor->envases = Input::post('envases');
            $proveedor->liquidado = Input::post('liquidado');

			if ($proveedor->save())	{
				Session::set_flash('success', '¡Proveedor actualizado!');
				Response::redirect('proveedor/'.$tipo);
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el proveedor seleccionado.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$proveedor->nombre = $val->validated('nombre');
				$proveedor->domicilio = $val->validated('domicilio');
				$proveedor->poblacion = $val->validated('poblacion');
				$proveedor->nifcif = $val->validated('nifcif');
				$proveedor->telefono = $val->validated('telefono');
				$proveedor->tipo = $val->validated('tipo');
                $proveedor->comentario = $val->validated('comentario');
                $proveedor->envases = $val->validated('envases');
                $proveedor->liquidado = $val->validated('liquidado');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('proveedor', $proveedor, false);
		}

		$this->template->title = "Proveedores";
		$this->template->content = View::forge('proveedor/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('proveedor');
        //$res1, $res2  = false;
		if ($proveedor = Model_Proveedor::find($id)){
            //$res1 = deleteAdvancesByProvider($id);
            //$res2 = deleteInvoicesByProvider($id);
            //if($res1) {
                $proveedor->delete();
                Session::set_flash('success', 'Proveedor borrado del sistema y todas sus facturas y albaranes.');
            //}
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el proveedor seleccionado');
		}
		Response::redirect('proveedor');
	}

}
