<?php
class Controller_Anticipo extends Controller_Template
{
    public function action_index()
    {
        $data['proveedores'] = Model_Proveedor::find('all', array('order_by' => 'nombre'));
        $this->template->title = "Calcular Anticipo";
        $this->template->content = View::forge('anticipo/index', $data);
    }

    public function action_init()
    {
        $data['proveedores'] = Model_Proveedor::find('all', array('order_by' => 'nombre'));
        $this->template->title = "Anticipo de un proveedor concreto";
        $this->template->content = View::forge('anticipo/init', $data);
    }

    public function action_list()
    {
        $data['anticipos'] = Model_Anticipo::find('all', array('where'=>array(array('fecha','>','2023-12-31')),'order_by' => array('fecha' => 'desc')));
        $this->template->title = "Anticipos: todos los registrados";
        $this->template->content = View::forge('anticipo/list', $data);
    }
	
	public function action_year($year){
         $anticipos = Model_Anticipo::find('all');
         $data["anticipos"] = array();
         foreach($anticipos as $a){
             if(strpos($a->fecha,$year) !== false){
                 $data["anticipos"][] = $a;
             }
         }
         $data['year'] = $year;
         $data['titulo'] = ": campaña $year.";
         $this->template->title = "Anticipos de la campaña $year";
         $this->template->content = View::forge('anticipo/list', $data);
     }
	
	public function action_sel_year($idprov){
		is_null($idprov) and Response::redirect('anticipo/list');
		$data["idprov"] = $idprov;
		$data["prov_name"] = Model_Proveedor::find($idprov)->get('nombre');
		$this->template->title = "Selecciona el año a consultar";
		$this->template->content = View::forge('entrega/sel_year',$data);
	}

    public function action_list_prov($idprov = null, $year = null){
        is_null($idprov) and Response::redirect('anticipo/list');
		
		is_null($year) and Response::redirect('anticipo/sel_year/'.$idprov);

        if (!$data['prov'] = Model_Proveedor::find($idprov)) {
            Session::set_flash('error', 'No se ha encontrado proveedor con ese identificador (#' . $idprov . ')');
            Response::redirect('anticipo/list');
        } else {
            $data['nombre_prov'] = Model_Proveedor::find($idprov)->get('nombre');
            $data['anticipos'] = Model_Anticipo::find('all', array('where' => array(array("idprov", $idprov),array('fecha', 'LIKE', $year.'%'))));
            $this->template->title = "Anticipos de un proveedor";
            $this->template->content = View::forge('anticipo/list_prov', $data);
        }
    }

    public function action_calculo(){
        $data['anticipos'] = Model_Anticipo::find('all');
        $this->template->title = "Cálculo Anticipo";
        $this->template->content = View::forge('anticipo/calculo', $data);
    }

    public function action_print($id = null){

        is_null($id) and Response::redirect('anticipo/list');

        if (!$anticipo = Model_Anticipo::find($id)) {
            Session::set_flash('error', 'No se ha encontrado el anticipo núm. ' . $id);
            Response::redirect('anticipo/list');
        }

        $data['anticipo'] = $anticipo;

        $this->template->title = "Anticipo Núm. " . $anticipo->get('id');
        $this->template->content = View::forge('anticipo/print', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('anticipo');

		if ( ! $data['anticipo'] = Model_Anticipo::find($id))
		{
			Session::set_flash('error', 'Could not find anticipo #'.$id);
			Response::redirect('anticipo');
		}

		$this->template->title = "Anticipo";
		$this->template->content = View::forge('anticipo/view', $data);

	}

	public function action_create()
	{
        $data["bancos"]=Model_Banco::find('all');
		if (Input::method() == 'POST')
		{
			$val = Model_Anticipo::validate('create');

			if ($val->run())
			{
				$anticipo = Model_Anticipo::forge(array(
					'fecha' => Input::post('fecha'),
					'idprov' => Input::post('idprov'),
					'numcheque' => Input::post('numcheque'),
					'idbanco' => Input::post('idbanco'),
					'cuantia' => Input::post('cuantia'),
					'recogido' => Input::post('recogido'),
				));

				if ($anticipo and $anticipo->save()){
                    \Fuel\Core\Session::delete('ses_anticipo_prov');
                    \Fuel\Core\Session::delete('ses_anticipo_cuantia');
					Session::set_flash('success', 'Anticipo añadido al sistema (#'.$anticipo->id.').');
					Response::redirect('anticipo/print/'.$anticipo->id);
				}
				else{
					Session::set_flash('error', 'No se pudo guardar el anticipo.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Anticipos";
		$this->template->content = View::forge('anticipo/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('anticipo');

		if ( ! $anticipo = Model_Anticipo::find($id))
		{
			Session::set_flash('error', 'Could not find anticipo #'.$id);
			Response::redirect('anticipo');
		}

        $data["bancos"]=Model_Banco::find('all');
		$val = Model_Anticipo::validate('edit');

		if ($val->run())
		{
			$anticipo->fecha = Input::post('fecha');
			$anticipo->idprov = Input::post('idprov');
			$anticipo->numcheque = Input::post('numcheque');
			$anticipo->idbanco = Input::post('idbanco');
			$anticipo->cuantia = Input::post('cuantia');
			$anticipo->recogido = Input::post('recogido');

			if ($anticipo->save()){
				Session::set_flash('success', 'Anticipo actualizado (#' . $id.').');
				Response::redirect('anticipo/list');
			}else{
				Session::set_flash('error', 'No se pudo actualizar el anticipo seleccionado');
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$anticipo->fecha = $val->validated('fecha');
				$anticipo->idprov = $val->validated('idprov');
				$anticipo->numcheque = $val->validated('numcheque');
				$anticipo->idbanco = $val->validated('idbanco');
				$anticipo->cuantia = $val->validated('cuantia');
				$anticipo->recogido = $val->validated('recogido');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('anticipo', $anticipo, false);
		}

		$this->template->title = "Anticipos";
		$this->template->content = View::forge('anticipo/edit',$data);

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('anticipo');

		if ($anticipo = Model_Anticipo::find($id))
		{
			$anticipo->delete();

			Session::set_flash('success', 'Anticipo borrado');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el anticipo');
		}
		Response::redirect('anticipo/list');
	}

}
